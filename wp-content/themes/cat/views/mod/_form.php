<?php
$formData = \App\Models\Form::getData($id);
$formConstructor = $formData['fields'];
?>




<!-- This is form <?= $id ?> -->
<form class="form">
    <?php if (isset($formConstructor)) : ?>
        <?php foreach ($formConstructor as $item) : ?>
            <?php require app('path.views') . '/mod/fields/' . $item['component'] . '.php'; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="btns-container">
        <button type="submit" class="btn secondary fill lg">Задати питання</button>
    </div>
</form>

<script>
    initializeForm(<?= json_encode($formConstructor) ?>);

    function initializeForm(formConstructor) {
        const isModal = JSON.parse(localStorage.isModalFormOpen) || null
        const form = document.querySelector('.form');
        const formWrapper = document.querySelector('.modal-form-content');
        const formComponent = formConstructor.filter(el => el.component !== 'FormTitle' && el.component !== 'FormText').map(el => el.content);

        const formFieldsCollection = [];
        formComponent.forEach(el => {
            if (Object.keys(el.rules).length) {
                const field = {
                    el: document.querySelector(`[name="${el.name}"]`),
                    name: el.name,
                    rules: el.rules,
                    messages: el.messages,
                };
                formFieldsCollection.push(field);

                if (!field.el) return;
                field.el.addEventListener('input', () => {
                    validateField(field);
                });
            }
        });
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const errors = formFieldsCollection.map(field => validateField(field)).filter(error => error);
            if (errors.length > 0) return;

            const formData = new FormData(form);
            formData.append('form_id', "<?= $id ?>");
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            fetch('/api/form/send', {
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(({
                    data
                }) => {
                    const div = document.createElement('div');
                    div.innerHTML = `<i class="ic-check-large"></i>
                        <div class="text">
                        <h3>${data.success_title}</h3>
                        <p>${data.success_text}</p>
                        </div>`;
                    if (isModal) {
                        div.classList.add('modal-success')
                        form.remove();
                        formWrapper.append(div)
                    } else {
                        div.classList.add('success');
                        form.append(div);
                        setTimeout(() => {
                            div.remove();
                        }, 4000)
                    }
                    form.reset();
                    if (isModal) {
                        localStorage.setItem('isModalFormOpen', false);
                    };
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        function validateField(field) {
            if (!field.el) return;
            const inputErrors = [];
            for (let rule in field.rules) {
                if (rule === 'required' && !!+field.rules[rule]) {
                    if (field.el.type === 'checkbox' && !field.el.checked) {
                        inputErrors.push(field.messages[rule]);
                    } else if (field.el.type !== 'checkbox' && !field.el.value.trim()) {
                        inputErrors.push(field.messages[rule]);
                    }
                }
                if (rule === 'email' && !!+field.rules[rule]) {
                    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                    if (!emailPattern.test(field.el.value)) {
                        inputErrors.push(field.messages[rule]);
                    }
                }
                if (rule === 'min' && field.el.value.length < +field.rules[rule] && !!+field.rules[rule]) {
                    inputErrors.push(field.messages[rule]);
                }
                if (rule === 'max' && field.el.value.length > +field.rules[rule] && !!+field.rules[rule]) {
                    inputErrors.push(field.messages[rule]);
                }
            }
            if (inputErrors.length > 0) {
                field.el.closest('.form-field').querySelector('.error').innerHTML = inputErrors[0];
                field.el.closest('.form-field').classList.add('error');
                return field;
            } else {
                field.el.closest('.form-field').querySelector('.error').innerHTML = '';
                field.el.closest('.form-field').classList.remove('error');
                return null;
            }
        }
    }
</script>