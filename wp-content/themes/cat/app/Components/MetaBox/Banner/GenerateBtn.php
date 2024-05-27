<?php

namespace App\Components\MetaBox\Banner;

use App\Core\MetaBox\BaseMetaBox;

class GenerateBtn extends BaseMetaBox
{
    public function html()
    {
    ?>
        <div style="width: 100%; text-align: right">
            <span class="btn btn-success text-white html-btn-generate">Згенерувати html</span>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $(document).on('click', '.html-btn-generate', function () {
                    const queryString = window.location.search;
                    const urlParams = new URLSearchParams(queryString);
                    const id = urlParams.get('post');

                    if(!id){
                        alert('Спочатку збережіть банер');
                        return;
                    }

                    $.ajax({
                        url:'/api/banner/generate',
                        type:'get',
                        data:{
                            id:id
                        },
                        success:function (res){
                            Swal.fire({
                                title: "Ваш html код",
                                input: "textarea",
                                inputValue: res,
                                inputAttributes: {
                                    style: 'height: 300px;' // Задайте потрібну висоту
                                },
                                showCancelButton: true,
                                confirmButtonText: 'Скопіювати',
                                cancelButtonText: "Відмінити",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    const textToCopy = result.value;

                                    // Створення тимчасового елемента textarea для копіювання
                                    const tempTextArea = document.createElement("textarea");
                                    tempTextArea.value = textToCopy;
                                    document.body.appendChild(tempTextArea);

                                    // Вибір та копіювання тексту
                                    tempTextArea.select();
                                    try {
                                        document.execCommand('copy');
                                        Swal.fire({
                                            title: 'HTML код скопійовано в буфер обміну',
                                        });
                                    } catch (err) {
                                        Swal.fire({
                                            title: 'Помилка',
                                            text: 'Не вдалося скопіювати текст: ' + err,
                                            icon: 'error'
                                        });
                                    }

                                    // Видалення тимчасового елемента textarea
                                    document.body.removeChild(tempTextArea);
                                }
                            });
                        },
                        error:function (){
                            console.log('error');
                        }
                    });
                });
            });
        </script>
    <?php
    }

    public static function beforeOutput($value)
    {
        return $value;
    }

    public static function beforeSave($value)
    {
        return $value;
    }
}