
document.addEventListener("DOMContentLoaded", () => {
	const formWrapper = document.querySelector(".modal-form-content");;
	const buttons = document.querySelectorAll('.render-form-btn');
	const attachFormButtonClickHandlers = () => {
		buttons.forEach(button => {
			button.addEventListener('click', (e) => {
				e.preventDefault();
				const id = button.getAttribute('data-form_id');
				getFormData(id);
			});
		});
	};

	const getFormData = (id) => {
		const url = '/api/form/get-data?id=' + id;

		fetch(url).then(res => {
			return res.json();
		}).then(data => {
			loadForm(id, data)
		});
	}

	const loadForm = (id, data) => {
		fetch(`/api/form/render?id=${id}`)
			.then(response => {
				if (response.ok) return response.text();
				throw new Error(`Request failed with status ${response.status}`);
			})
			.then(html => {
				const container = document.querySelector(".modal-form-content");
				container.innerHTML = html;

				modalFormShow();
				initializeMask();

				const form = container.querySelector('form');
				if (form) {
					initForm(data)
					addSubmitListenerToForm(form);
				}
			})
			.catch(error => console.error('Error loading form:', error));
	};

	const initializeMask = () => {
		const elements = document.querySelectorAll('.phone');
		const maskOptions = {
			mask: '+{38}0-0000-00-000'
		};
		elements.forEach(el => {
			IMask(el, maskOptions);
		});
	};

	// Функция для добавления обработчика событий form на submit
	function addSubmitListenerToForm(form) {
		const options = form.querySelectorAll('.option')
		options.forEach(option => {
			option.addEventListener('click', ({ target }) => {
				updateHiddenInput(target, target.dataset.value)
			})
		})
		form.addEventListener('submit', (e) => {
			e.preventDefault();
			const errors = formFieldsCollection.map(field => validateField(field)).filter(error => error);
			console.log(errors);
			if (errors.length > 0) return;
			
			const formData = new FormData(e.target);
			formData.append('form_id', e.target.dataset.form);
			const data = {};
			formData.forEach((value, key) => {
				data[key] = value;
			});
			sendForm(data)
		});
	}

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

	// Начальное присвоение обработчика событий
	// let forms = document.querySelectorAll('.modal-form > [id^="tg-form-"]');
	// forms.forEach(addSubmitListenerToForm);

	// Наблюдатель за мутациями, который будет добавлять обработчики для новых форм
	const observer = new MutationObserver((mutations) => {
		mutations.forEach(mutation => {
			if (mutation.addedNodes && mutation.addedNodes.length > 0) {
				mutation.addedNodes.forEach(node => {
					// Проверяем, является ли добавленный узел элементом формы и соответствует ли он нашему паттерну
					if (node.nodeType === Node.ELEMENT_NODE && node.matches('.modal-form > [id^="tg-form-"]')) {
						addSubmitListenerToForm(node);
					}
				});
			}
		});
	});

	const sendForm = (formData) => {
		fetch('/api/form/send', {
			method: 'POST',
			body: JSON.stringify(formData),
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
	}

	// Конфигурация наблюдателя: следим за добавлением дочерних элементов
	const config = { childList: true, subtree: true };
	observer.observe(document.body, config);

	let formComponents;
	const formFieldsCollection = [];
	const initForm = (formConstructor) => {
		formComponents = formConstructor.fields.filter(el => el.component !== 'FormTitle' && el.component !== 'FormText').map(el => el.content)
		formComponents.forEach(el => {
			if (Object.keys(el.rules).length) {
				const field = {
					el: formWrapper.querySelector(`[name="${el.name}"]`),
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

	}


	function updateHiddenInput(target, value) {
		const parentEl = target.closest('.form-field')
		const allOptions = parentEl.querySelectorAll('.option')
		allOptions.forEach(e => {
			e.classList.remove('active')
		})
		target.classList.add('active')
		const hiddenInput = parentEl.querySelector('input');
		hiddenInput.value = value;
	}

	attachFormButtonClickHandlers();
	initializeMask();

})