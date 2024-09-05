String.prototype.replaceAll = function(search, replace)
{
    return this.split(search).join(replace);
}


function createItem(containerObject, scopeItemObject, itemsObject, templateString)
{
    const cloneItem = scopeItemObject
        .clone()[0]
        .outerHTML
        .replaceAll(templateString, getItemId(itemsObject.children()));

    itemsObject.append(cloneItem);
}

function createItemFromTemplate(containerObject, scopeItemObject, itemsObject, templateString)
{
    const cloneItem = scopeItemObject
        .clone()[0]
        .outerHTML
        .replaceAll(templateString, getItemId(itemsObject.children()));

    itemsObject.append(cloneItem);
}

function deleteItem(buttonObject)
{
    buttonObject
        .closest('.item-list-template')
        .remove();
}

function getItemId(items)
{
    if (items.length > 0)
    {
        const arrayItems = [];

        for (let i = 0; i < items.length; i++)
        {
            let propertyValue = +jQuery(items[i]).attr('data-item-id');

            arrayItems.push(propertyValue);
        }

        return Math.max.apply(null, arrayItems) + 1;
    }

    return 1;
}

function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));

    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options)
{
    options = options || {};

    let expires = options.expires;

    if (typeof expires == "number" && expires)
    {
        let d = new Date();
        d.setTime(d.getTime() + expires * 1000);
        expires = options.expires = d;
    }

    if (expires && expires.toUTCString)
    {
        options.expires = expires.toUTCString();
    }

    value = encodeURIComponent(value);

    let updatedCookie = name + "=" + value;

    for (let propName in options)
    {
        updatedCookie += "; " + propName;
        let propValue = options[propName];
        if (propValue !== true)
        {
            updatedCookie += "=" + propValue;
        }
    }

    document.cookie = updatedCookie;
}

function deleteCookie(name)
{
    setCookie(name, '', {
        expires: -1
    })
}


/* Building MetaBox Constructor handler */
jQuery(document).ready(function($)
{
    $(document).on('click', '.attach-image', function (e) {
        choiceImage(e, $(this));
    });

    $(document).on('change', '.show-hide-checkbox', function()
    {
        onOffBlock(this);
    });

    /* Delete component */
    $(document).on('click', '.delete-component-button', function(e)
    {
        e.preventDefault();

        const that = this;
        const confirmDeletePopUp = $(that)
            .parents('.component-container')
            .find('.confirm-delete-component');
        confirmDeletePopUp.show();
        confirmDeletePopUp
            .find('.confirm-action-button')
            .on('click', function()
            {
                if ($(this).attr('data-confirm') === 'confirm')
                {
                    $(this).parent().parent().remove();
                    confirmDeletePopUp.hide();
                }
                else
                {
                    confirmDeletePopUp.hide();
                }
            });

        $(document).on('click', function (e)
        {
            if (!confirmDeletePopUp.is(e.target) && !$(that).is(e.target) && confirmDeletePopUp.has(e.target).length === 0)
            {
                confirmDeletePopUp.hide();
            }
        });
    });
    /* End Delete component */

    function refreshOrder(elements)
    {
        if (elements.length > 0)
        {
            elements.forEach(function (item, i)
            {
                $('#' + elements[i])
                    .find('.position-component')
                    .val(i + 1);
            });
        }
    }

    function onOffBlock(element)
    {
        const blockBodyFields = $(element)
            .parents('.component-container')
            .find('.display-layout');

        if ($(element).is(':checked'))
        {
            blockBodyFields.removeClass('display-off');
        }
        else
        {
            blockBodyFields.addClass('display-off');
        }
    }

    function computationComponentId(componentsContainer)
    {
        const components = componentsContainer.children();

        if (components.length > 0)
        {
            const arrayComponents = [];

            for (let i = 0; i < components.length; i++)
            {
                let propertyValue = +$(components[i]).attr('data-component-id');
                arrayComponents.push(propertyValue);
            }

            return Math.max.apply(null, arrayComponents) + 1;
        }

        return 1;
    }

    /* Create component */
    $('.clone-component').on('click', function (e)
    {
        const componentName = $(this).attr('data');
        const constructor = $(this).closest('.constructor-section');
        const componentsContainer = constructor.find('.components-container');
        const componentsScopes = constructor.find('.componentsScopes');
        const componentPlaceholder = constructor.find('input[name=component_placeholder]').val();

        const cloneComponent = componentsScopes.find('.' + componentName)
            .clone()[0]
            .outerHTML
            .replaceAll(componentPlaceholder, computationComponentId(componentsContainer));

        componentsContainer.append(cloneComponent);

        componentsContainer.find(".select2-preset").select2({
            minimumResultsForSearch: Infinity,
            templateResult: function(data) {
                // Перевірка, чи має елемент атрибут 'data-color'
                if (!data.element) {
                    return data.text;
                }

                // Створення HTML-коду для відображення кольору перед назвою
                var $color = $('<span class="color-option" style="background-color:' + $(data.element).data('color') + '"></span>');
                var $text = $('<span style="vertical-align: top;">' + data.text + '</span>');

                return $color.add($text);
            },
            templateSelection: function(data) {
                // Відображення обраного елементу з кольором
                if (!data.element) {
                    return data.text;
                }

                var $color = $('<span class="color-option" style="background-color:' + $(data.element).data('color') + '"></span>');
                var $text = $('<span style="vertical-align: top;">' + data.text + '</span>');

                return $color.add($text);
            }
        });

        const sortableArray = componentsContainer
            .sortable('refreshPositions')
            .sortable('toArray');
        refreshOrder(sortableArray);

        const urlWithoutHash = document.location.href.replace(location.hash , '');
        scrollToSection($(cloneComponent).attr('id'));
    });
    /* End Create component */

    function scrollToSection(sectionId) {
        var section = document.getElementById(sectionId);
        if (section) {
            window.scrollTo({
                top: section.offsetTop,
                behavior: 'smooth' // Додаємо плавність прокрутки
            });
        }
    }

    $(function()
    {
        $(".constructor-section").each(function(){
            const componentsContainer = $(this).find('.components-container');

            // /* Slide hide components */
            const components = componentsContainer.find('.component-container');

            if (components.length > 0)
            {
                components.each(function ()
                {
                    const indicator  = $(this).find('.toggle-indicator');
                    const body = $(this).find('.body-block');
                    const separator = $(this).find('.separator-block');
                    const btns = $(this).find('.btns-block');
                    const footer = $(this).find('.footer-block');

                    indicator.addClass('slide-up-true');
                    body.slideUp(0);
                    separator.slideUp(0);
                    btns.slideUp(0);
                    footer.slideUp(0);
                });
            }

            componentsContainer.find(".select2-preset").select2({
                minimumResultsForSearch: Infinity,
                templateResult: function(data) {
                    // Перевірка, чи має елемент атрибут 'data-color'
                    if (!data.element) {
                        return data.text;
                    }

                    // Створення HTML-коду для відображення кольору перед назвою
                    var $color = $('<span class="color-option" style="background-color:' + $(data.element).data('color') + '"></span>');
                    var $text = $('<span style="vertical-align: top;">' + data.text + '</span>');

                    return $color.add($text);
                },
                templateSelection: function(data) {
                    // Відображення обраного елементу з кольором
                    if (!data.element) {
                        return data.text;
                    }

                    var $color = $('<span class="color-option" style="background-color:' + $(data.element).data('color') + '"></span>');
                    var $text = $('<span style="vertical-align: top;">' + data.text + '</span>');

                    return $color.add($text);
                }
            });

            /* Show / hide component */
            componentsContainer.find('.show-hide-checkbox').each(function ()
            {
                onOffBlock(this);
            });

            /* Sorted components */
            componentsContainer.sortable({
                handle: '.move-label',
                axis: 'y',
                tolerance: 'pointer',
                cursor: 'move',
                update: function(event, ui)
                {
                    const sortableArray = $(this).sortable('toArray');
                    refreshOrder(sortableArray);
                }
            });
            /* End Sorted components */
        });
    });

    $(document).on('click', '.slide-up', function()
    {
        const component = $(this).parents('.component-container');
        const componentId = component.attr('id');
        const indicator  = $(this).find('.toggle-indicator');
        const body = component.find('.body-block');
        const separator = component.find('.separator-block');
        const btns = component.find('.btns-block');
        const footer = component.find('.footer-block');

        if (indicator.hasClass('slide-up-true'))
        {
            // setCookie(componentId, 'showed', {expires:3600, path:'/'});
            indicator.removeClass('slide-up-true');
            body.slideDown(0);
            separator.slideDown(0);
            btns.slideDown(0);
            footer.slideDown(0);
        }
        else
        {
            // setCookie(componentId, 'hidden', {expires:3600, path:'/'});
            indicator.addClass('slide-up-true');
            body.slideUp(0);
            separator.slideUp(0);
            btns.slideUp(0);
            footer.slideUp(0);
        }
    });
    /* End Slide show/hide components */

    $(document).on('click', '.add-button-component', function () {
        const placeholder = $(this).data('placeholder');
        const container = $(this).parents('.btns-block');
        const template = container.find('template')[0];
        const itemTemplate = $(template.content).find(".item-list-template");
        const itemsContainer = container.find('.list-elements-container');

        createItemFromTemplate(container, itemTemplate, itemsContainer, placeholder);

        itemsContainer.find('.icon-select-component').each(function () {
            $(this).select2({
                templateResult: formatStateIcon,
                templateSelection: formatStateIcon,
            });
        });
    });

    $(document).on('click', '.delete-list-element', function () {
        deleteItem($(this));
    });

    $(".icon-select-component-ready").each(function () {
        $(this).select2({
            templateResult: formatStateIcon,
            templateSelection: formatStateIcon,
        });
    });

    $(document).on("change", ".type_link", function () {
        let type = $(this).val();

        if (type == 'form') {
            $(this).closest('.card-body').find('.type_link_link, .type_link_link_target').hide();
            $(this).closest('.card-body').find('.type_link_form').show();
        } else {
            $(this).closest('.card-body').find('.type_link_link, .type_link_link_target').show();
            $(this).closest('.card-body').find('.type_link_form').hide();
        }
    });
});
/* End Building MetaBox Constructor handler */


/* For choice and remove images in MetaBox */
function choiceImage(e, obj) {
    e.preventDefault();

    let frame;
    let imageWrapper = jQuery(obj).parents('.image-wrapper');

    if (frame) {
        frame.open();
        return;
    }

    frame = wp.media.frames.questImgAdd = wp.media({
        states: [
            new wp.media.controller.Library({
                //title: 'Добавить изображекние',
                library: wp.media.query(),
                multiple: false
                //date: false
            })
        ],
        button: {
            //text: '',
        }
    });

    frame.on('select', function () {
        const selected = frame
            .state()
            .get('selection')
            .first()
            .toJSON();
        if (selected) {
            let ext = selected.filename.split('.').pop();
            let imageExt = ["jpg","jpeg","gif","svg","png","bmp","webm"];

            imageWrapper.find('.image-id').val(selected.id);

            if (imageExt.includes(ext.toLowerCase())) {
                // це зображення
                imageWrapper.find('img').attr('src', selected.sizes.full.url);
            } else {
                // Це не зображення
                imageWrapper.find('img').attr('src', '/wp-content/themes/cat/img/file-ext/'+ext+'.png');
            }
        }
    });

    frame.on('open', function () {
        const imageID = imageWrapper.find('.image-id').val();
        if (imageID) {
            frame
                .state()
                .get('selection')
                .add(wp.media.attachment(imageID));
        }
    });
    frame.open();
}

function removeImage(obj) {

    jQuery(obj).parent().find('.image-id').val('0');
    jQuery(obj).parent().find('img').attr('src', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkAQMAAABKLAcXAAAABlBMVEUAAAC7u7s37rVJAAAAAXRSTlMAQObYZgAAACJJREFUOMtjGAV0BvL/G0YMr/4/CDwY0rzBFJ704o0CWgMAvyaRh+c6m54AAAAASUVORK5CYII=');
}
/* End For choice and remove images in MetaBox */

/* Choice many images */
function choiceManyImages(e, obj, image_name) {
    e.preventDefault();

    button_text = 'Remove'

    let frame;
    let galleryContainer = $(obj).parent().find('.gallery-container');

    if (frame) {
        frame.open();
        return;
    }

    frame = wp.media.frames.questImgAdd = wp.media({
        states: [
            new wp.media.controller.Library({
                //title: 'Добавить изображекние',
                library: wp.media.query({type: 'image'}),
                multiple: true
                //date: false
            })
        ],
        button: {
            //text: '',
        }
    });

    frame.on('select', function () {
        const selected = frame
            .state()
            .get('selection')
            .toJSON();
        if (selected) {
            if (selected.length > 0) {
                const componentPosition = galleryContainer.parents('.component-container').attr('data-component-id');

                selected.forEach(function(item, i, arr) {
                    const itemPosition = getItemId(galleryContainer.children())

                    let image_block = '<li data-item-id=' + itemPosition + ' class="gallery-items"><div class="image-wrapper"><img src="' + item.sizes.full.url + '" alt=""><textarea name="' + image_name + '[' + componentPosition + '][content][images][' + itemPosition + '][title]"></textarea><button type="button" class="button button-secondary remove-image">' + button_text + '</button><input type="hidden" name="' + image_name + '[' + componentPosition + '][content][images][' + itemPosition + '][id]" value="' + item.id + '" class="image-id"></div></li>'

                    galleryContainer.append(image_block);
                });
            }
        }
    });

    frame.open();
}
/* End Choice many images */
const cb = function (callback) {
    $('#exampleModalBtn').modal('show');
    $(".cb-btn-submit").on("click",function () {
       
        let data = {
            text:$(".cb-input-text").val(),
            type_link:$(".cb-input-type_link").val(),
            link:$(".cb-input-link").val(),
            link_target:$(".cb-input-link_target").prop('checked'),
            form:$(".cb-input-form").val(),
            color_button:$(".cb-input-color_button").val(),
            size_button:$(".cb-input-size_button").val(),
            type_button:$(".cb-input-type_button").val(),
            icon:$(".cb-input-icon-wrapper").find("select").val(),
        };
        let a = document.createElement('a');
        a.className = "cb-component " + data.type_button;

        a.innerHTML = data.text;

        if(data.icon){
            a.innerHTML += "<i class='icon "+data.icon+"'></i>";
        }

        if(data.type_link == "link"){
            a.setAttribute('href',data.link);
            if(data.link_target){
                a.setAttribute('target','_blank');
            }
        } else {
            a.setAttribute('href',"javascript:void(0)");
            a.className += " render-form-btn";
            a.setAttribute('data-form_id',data.form);
        }

        a.className += " btn-color--" + data.color_button;
        a.className += " btn-size--" + data.size_button;

        callback(a);
        $(".cb-input-link").val('');
        $(".cb-input-text").val('');
        $('#exampleModalBtn').modal('hide');
        $(".cb-btn-submit").off('click');
    })
};

const CustomButton = function (context) {

    const ui = $.summernote.ui;
    const button = ui.button({
        contents: '<i class="fa fa-leaf"></i> Кнопка',
        tooltip: 'Вставити кнопку',
        click: function () {
            $(".cb-btn-submit").off('click');
            cb(function (btn) {
                let rng = context.$note.summernote('getLastRange');
                let node = rng.insertNode(btn);
                let code = context.$note.summernote('code');

                context.$note.summernote('code','');
                context.invoke('pasteHTML', code);
            });
        }
    });

    return button.render();
};

const MoreButton = function (context) {
    const ui = $.summernote.ui;
    const button = ui.button({
        contents: 'Читати далі',
        tooltip: 'Читати далі',
        click: function () {
            context.invoke('editor.pasteHTML', '<span class="hideMarker" style="color:red">сховати весь текст внизу</span>');
        }
    });

    return button.render();
};

summernote_options = {
    lang: 'uk-UA',
    height: 250,
    minHeight: null,
    maxHeight: null,
    toolbar: [
        ['undoredo', ['undo', 'redo']],
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear',
            'tags_replace', 'tags_replace_all'
        ]],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['height', ['height']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table', 'specialchars']],
        ['insert', ['link', 'hr']],
        ['view', ['fullscreen', 'codeview']],
        ['typography', ['typography']],
        ['popovers', ['cb','rdm','image']]
    ],
    buttons: {
        cb: CustomButton,
        rdm: MoreButton,
        image: function(context) {
            var button = $('<button class="note-btn btn btn-default btn-sm" type="button" title="Вставити зображення" tabindex="-1"><i class="note-icon-picture"></i></button>');
            button.click(function() {
                let frame;
                if (frame) {
                    frame.open();
                    return;
                }

                frame = wp.media({
                    title: 'Виберіть або завантажте файл',
                    button: {
                        text: 'Вибрати'
                    },
                    multiple: false
                });

                frame.on('select', function() {
                    var attachment = frame.state().get('selection').first().toJSON();
                    context.invoke('insertImage', attachment.url);
                });

                frame.open();
            });
            return button;
        }
    },
};