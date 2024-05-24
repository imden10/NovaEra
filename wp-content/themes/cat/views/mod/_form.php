<?php
$formData = \App\Models\Form::getData($id);
$formConstructor = $formData['fields'];
$success = [
    'title' => $formData['success_text'],
]
?>




<!-- This is form <?= $id ?> -->
<!-- <pre>
<?php print_r($formConstructor) ?>
</pre> -->
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
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.form');
        const formComponent = <?= json_encode($formConstructor) ?>
            .filter(el => el.component !== 'FormTitle' && el.component !== 'FormText').map(el => el.content);

        const formFieldsCollection = []
        formComponent.forEach(el => {
            if (Object.keys(el.rules).length) {
                const field = {
                    el: document.querySelector(`[name="${el.name}"]`),
                    name: el.name,
                    rules: el.rules,
                    messages: el.messages,
                };
                formFieldsCollection.push(field);

                // Добавляем обработчик события input для каждого поля формы
                if (!field.el) return
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
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            console.log(data);
            // Отправить данные через fetch или другим способом
            fetch('your-server-endpoint', {
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        function validateField(field) {
            const inputErrors = [];
            if (!field.el) return
            for (let rule in field.rules) {
                if (rule === 'required' && !field.el.value) {
                    inputErrors.push(field.messages[rule]);
                }
                if (rule === 'email') {
                    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                    if (!emailPattern.test(field.el.value)) {
                        inputErrors.push(field.messages[rule]);
                    }
                }
                if (rule === 'min' && field.el.value.length < +field.rules[rule]) {
                    inputErrors.push(field.messages[rule]);
                }
                if (rule === 'max' && field.el.value.length > +field.rules[rule]) {
                    inputErrors.push(field.messages[rule]);
                }
            }
            if (inputErrors.length > 0) {
                console.log(inputErrors);
                field.el.nextElementSibling.innerHTML = inputErrors[0];
                return field;
            } else {
                field.el.nextElementSibling.innerHTML = '';
                return null;
            }
        }



        // const form = document.querySelector('.form');
        // form.addEventListener('submit', (e) => {
        //     e.preventDefault();

        //     const formData = new FormData(form);
        //     const data = {};

        //     formData.forEach((value, key) => {
        //         data[key] = value;
        //     });

        //     const formComponent = <?= json_encode($formConstructor) ?>
        //         .filter(el => el.component !== 'FormTitle' && el.component !== 'FormText').map(el => el.content);

        //     const formFieldsCollection = []
        //     formComponent.forEach(el => {
        //         if (Object.keys(el.rules).length) {
        //             formFieldsCollection.push({
        //                 el: document.querySelector(`[name="${el.name}"]`),
        //                 name: el.name,
        //                 rules: el.rules,
        //                 messages: el.messages,
        //             })
        //         }
        //     });
        //     const errors = []
        //     formFieldsCollection.forEach(field => {
        //         if (!field.el) return
        //         for (rule in field.rules) {
        //             if (rule === 'required' && !field.el.value) {
        //                 errors.push({
        //                     el: field.el,
        //                     name: field.name,
        //                     rule,
        //                     messages: field.messages[rule]
        //                 })
        //             }
        //             if (rule === 'email') {
        //                 const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        //                 if (!emailPattern.test(field.el.value)) {
        //                     errors.push({
        //                         el: field.el,
        //                         name: field.name,
        //                         rule,
        //                         messages: field.messages[rule]
        //                     })
        //                     // errors.push('Введите корректный email.');
        //                 }
        //             }

        //             // Проверка на минимальную длину
        //             if (rule === 'min' && field.el.value.length < field.rules[rule]) {
        //                 errors.push({
        //                     el: field.el,
        //                     name: field.name,
        //                     rule,
        //                     messages: field.messages[rule]
        //                 })
        //                 // errors.push(`Минимальная длина поля: ${rule.min} символов.`);
        //             }

        //             // Проверка на максимальную длину
        //             if (rule === 'max' && field.el.value.length > field.rules[rule]) {
        //                 errors.push({
        //                     el: field.el,
        //                     name: field.name,
        //                     rule,
        //                     messages: field.messages[rule]
        //                 })
        //                 // errors.push(`Максимальная длина поля: ${rule.max} символов.`);
        //             }
        //         }
        //     })

        //     if (errors.length > 0) {
        //         errors.forEach(error => {
        //             error.el.nextElementSibling.innerHTML = error.messages
        //         })
        //         return;
        //     }

        //     console.log(data);

        //     // Отправить данные через fetch или другим способом
        //     fetch('your-server-endpoint', {
        //             method: 'POST',
        //             body: JSON.stringify(data),
        //             headers: {
        //                 'Content-Type': 'application/json'
        //             }
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             console.log('Success:', data);
        //         })
        //         .catch(error => {
        //             console.error('Error:', error);
        //         });

        //     console.table(errors);
        //     console.log(formComponent);
        //     console.log(formFieldsCollection);
        // });




        // const form = document.querySelector('.form');
        // form.addEventListener('submit', (e) => {
        //     e.preventDefault();

        //     const formData = new FormData(form);
        //     const data = {};

        //     formData.forEach((value, key) => {
        //         data[key] = value;
        //     });

        //     const formComponent = <?= json_encode($formConstructor) ?>
        //         .filter(el => el.component !== 'FormTitle' && el.component !== 'FormText').map(el => el.content);

        //     const formFieldsCollection = []
        //     formComponent.forEach(el => {
        //         if (Object.keys(el.rules).length) {
        //             const field = {
        //                 el: document.querySelector(`[name="${el.name}"]`),
        //                 name: el.name,
        //                 rules: el.rules,
        //                 messages: el.messages,
        //             };
        //             formFieldsCollection.push(field);
        //             if ( !field.el ) return
        //             field.el.addEventListener('input', () => {
        //                 const errors = [];
        //                 for (let rule in field.rules) {
        //                     if (rule === 'required' && !field.el.value) {
        //                         errors.push(field.messages[rule]);
        //                     }
        //                     if (rule === 'email') {
        //                         const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        //                         if (!emailPattern.test(field.el.value)) {
        //                             errors.push(field.messages[rule]);
        //                         }
        //                     }
        //                     if (rule === 'min' && field.el.value.length < field.rules[rule]) {
        //                         errors.push(field.messages[rule]);
        //                     }
        //                     if (rule === 'max' && field.el.value.length > field.rules[rule]) {
        //                         errors.push(field.messages[rule]);
        //                     }
        //                 }
        //                 if (errors.length === 0) {
        //                     // Если ошибок нет, убираем сообщение об ошибке
        //                     field.el.nextElementSibling.innerHTML = '';
        //                 }
        //             });
        //         }
        //     });

        //     const errors = []
        //     formFieldsCollection.forEach(field => {
        //         if (!field.el) return
        //         for (rule in field.rules) {
        //             if (rule === 'required' && !field.el.value) {
        //                 errors.push({
        //                     el: field.el,
        //                     name: field.name,
        //                     rule,
        //                     messages: field.messages[rule]
        //                 })
        //             }
        //             if (rule === 'email') {
        //                 const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        //                 if (!emailPattern.test(field.el.value)) {
        //                     errors.push({
        //                         el: field.el,
        //                         name: field.name,
        //                         rule,
        //                         messages: field.messages[rule]
        //                     })
        //                 }
        //             }

        //             // Проверка на минимальную длину
        //             if (rule === 'min' && field.el.value.length < field.rules[rule]) {
        //                 errors.push({
        //                     el: field.el,
        //                     name: field.name,
        //                     rule,
        //                     messages: field.messages[rule]
        //                 })
        //             }

        //             // Проверка на максимальную длину
        //             if (rule === 'max' && field.el.value.length > field.rules[rule]) {
        //                 errors.push({
        //                     el: field.el,
        //                     name: field.name,
        //                     rule,
        //                     messages: field.messages[rule]
        //                 })
        //             }
        //         }
        //     })

        //     if (errors.length > 0) {
        //         errors.forEach(error => {
        //             error.el.nextElementSibling.innerHTML = error.messages
        //         })
        //         return;
        //     }

        //     console.log(data);

        //     // Отправить данные через fetch или другим способом
        //     fetch('your-server-endpoint', {
        //             method: 'POST',
        //             body: JSON.stringify(data),
        //             headers: {
        //                 'Content-Type': 'application/json'
        //             }
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             console.log('Success:', data);
        //         })
        //         .catch(error => {
        //             console.error('Error:', error);
        //         });

        //     console.table(errors);
        //     console.log(formComponent);
        //     console.log(formFieldsCollection);
        // });
    });
</script>