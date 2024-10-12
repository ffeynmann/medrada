// var app = {};

document.addEvent('DOMContentLoaded', function(){


	let app = {
		init: function(){
			var phoneInputs = jQuery('input[name=phone]');

			if(phoneInputs.length) {
				phoneInputs.mask('+38 (999) 999-99-99');

				phoneInputs.each(function(index, node){
					node.addEvent('focus', function(e){
						setTimeout(function(){
							e.target.setCaretPosition(5);
						}, 50);
					});
				});
			}
		}
	};

	jQuery('a[href*=tel]').on('click', function(e){
		gtag('event', 'submit',
			{'event_category': 'phone',
				'event_action': 'click'})
	})

	app.init();

	new ErrorsControl();


	document.querySelectorAll('.call-me-wrapper form').forEach(function(v){
		v.control = new CallMeControl(v);
	});

	document.querySelectorAll('.write-us a').forEach(function(v){
		v.control = new WriteUsPopupControl(v);
	});

	document.querySelectorAll('.contact-us-wrapper').forEach(function(v){
		v.control = new ContactUsControl(v);
	});

	document.querySelectorAll('.s-packages-wrapper').forEach(function(v){
		v.control = new SPackagesControl(v);
	});

	document.querySelectorAll('[data-tooltip-html]').addEvent('click', function(e){
		app.errorsControl.add([e.target.dataset.tooltipHtml]);
	});


	function CallMeControl(node)
	{
		app.CallMeControl = this;

		this.form = node;

		this.init = function(){

			this.values = {};
			this.inputs = {
				phone: this.form.querySelector('[name=phone]')
			};

			this.form.addEvent('submit', this.grab.bind(this));

		};

		this.grab = function(e){
			e.preventDefault();

			if(!this.inputs.phone.value.length) {
				app.errorsControl.add([this.form.dataset.emptyPhone]);
				return;
			}

			this.values = {
				phone: this.inputs.phone.value
			};

			this.send();
		};

		this.send = function(){
			xh.ajax(vars.ajax, {
				dataType: 'json',
				method: 'POST',
				data: {action: 'sub', route: 'call-me', 'form': this.values},
				success: function(){
					jQuery('.modal-write-us-ok').modal('show');
					this.clear();
				}.bind(this)
			});
		};

		this.clear = function(){
			this.inputs.phone.value = '';
		};

		this.init();
	}

	function WriteUsPopupControl(node)
	{
		app.WriteUsPopupControl = this;

		this.link = node;
		this.modal = document.querySelector('#modal-write-us');

		this.inputs = {};
		this.values = {};

		this.init = function(){
			if(!this.link || !this.modal) {
				console.error('Write us popup not found!');
				return;
			}

			this.grabButton = this.modal.querySelector('input[type=submit]');
			this.grabButtonInited = false;

			this.link.addEvent('click', function(e){
				e.preventDefault();
				this.open();
			}.bind(this));

			if(!this.grabButtonInited) {
				this.grabButton.addEvent('click', this.grab.bind(this));
				this.grabButtonInited = 1;
			}


			this.modal.querySelectorAll('input').addEvent('focus', function(){
				this.classList.remove('border-invalid')
			});


			this.inputs = {
				name: this.modal.querySelector('[name=name]'),
				phone: this.modal.querySelector('[name=phone]'),
				comment: this.modal.querySelector('[name=comment]')
			};
		};

		this.pleaseFill = function () {
			this.inputs.name.classList[this.values.name.length ? 'remove' : 'add']('border-invalid');
			this.inputs.phone.classList[this.values.phone.length ? 'remove' : 'add']('border-invalid');
			this.grabButton.value = this.grabButton.dataset.textError;
			this.grabButton.classList.add('bg-invalid');

			setTimeout(function(){
				this.grabButton.value = this.grabButton.dataset.textOriginal;
				this.grabButton.classList.remove('bg-invalid');
			}.bind(this), 2000);
		};

		this.grab = function(){
			this.values.name = this.inputs.name.value;
			this.values.phone = this.inputs.phone.value;
			this.values.comment = this.inputs.comment.value;

			if(!this.values.name.length || !this.values.phone.length) {
				this.pleaseFill();
				return;
			}

			this.send();
		};

		this.send = function(){

			jQuery(this.modal).modal('hide');

			xh.ajax(vars.ajax, {
				dataType: 'json',
				method: 'POST',
				data: {action: 'sub', route: 'write-us', 'form': this.values},
				success: function(c){
					jQuery('.modal-write-us-ok').modal('show');
					this.clear();
				}.bind(this)
			});
		};

		this.clear = function(){
			this.inputs.name.value = '';
			this.inputs.phone.value = '';
			this.inputs.comment.value = '';
		};

		this.open = function(){
			jQuery(this.modal).modal('show');
		};

		this.init();
	}

	function ContactUsControl(wrapper)
	{
		app.ContactUsControl = this;
		this.wrapper = wrapper;

		this.grabButton = this.wrapper.querySelector('input[type=submit]');

		this.inputs = {

		};
		this.values = {};

		this.init = function(){
			this.grabButton.addEvent('click', this.grab.bind(this));

			this.inputs = {
				section: this.wrapper.querySelector('[name=section]'),
				name: this.wrapper.querySelector('[name=name]'),
				phone: this.wrapper.querySelector('[name=phone]'),
				comment: this.wrapper.querySelector('[name=comment]')
			};

			this.wrapper.querySelectorAll('input').addEvent('focus', function(){
				this.classList.remove('border-invalid')
			});
		};

		this.pleaseFill = function () {
			this.inputs.name.classList[this.values.name.length ? 'remove' : 'add']('border-invalid');
			this.inputs.phone.classList[this.values.phone.length ? 'remove' : 'add']('border-invalid');
			this.grabButton.value = this.grabButton.dataset.textError;
			this.grabButton.classList.add('bg-invalid');

			setTimeout(function(){
				this.grabButton.value = this.grabButton.dataset.textOriginal;
				this.grabButton.classList.remove('bg-invalid');
			}.bind(this), 2000);
		};

		this.grab = function(){
			this.values.section = this.inputs.section.value;
			this.values.name = this.inputs.name.value;
			this.values.phone = this.inputs.phone.value;
			this.values.comment = this.inputs.comment.value;

			if(!this.values.name.length || !this.values.phone.length) {
				this.pleaseFill();
				return;
			}

			this.send();
		};

		this.send = function(){
			jQuery(this.modal).modal('hide');

			xh.ajax(vars.ajax, {
				dataType: 'json',
				method: 'POST',
				data: {action: 'sub', route: 'write-us', 'form': this.values},
				success: function(c){
					jQuery('.modal-write-us-ok').modal('show');
					this.clear();
				}.bind(this)
			});
		};

		this.clear = function(){
			this.inputs.name.value = '';
			this.inputs.phone.value = '';
			this.inputs.comment.value = '';
		};

		this.init();
	}

	function ErrorsControl()
	{
		app.errorsControl = this;
		this.modal = jQuery('#modal-error');
		this.inner = this.modal.get(0).querySelector('.errors-inner');

		this.init = function(){};

		this.add = function(errors){
			var html = '';

			errors.forEach(function(error){
				html += '<p>' + error + '</p>';
			});

			this.inner.innerHTML = html;
			this.modal.modal('show');
		};

		this.init();
	}


	function SPackagesControl(node)
	{
		this.wrapper = node;

		this.init = function(){

			this.table = this.wrapper.querySelector('table');
			this.thead = this.wrapper.querySelector('thead');
			this.adminBar = !!document.querySelector('.gt3_wp-admin-bar');
			this.headerSticky = !!document.querySelector('.sticky_header.sticky_on');

			window.addEvent('scroll', function(){
				this.headerSticky = !!document.querySelector('.sticky_header.sticky_on');

				var top = this.table.getBoundingClientRect().top;

				this.adminBar && window.innerWidth < 782 ? (top -= 46) : (top -= 32);
				this.headerSticky && window.innerWidth > 1200 && (top -= 90);

				if(top < 0) {
					top = top * -1;
					this.thead.style.transform = 'translate3d(0, ' + top + 'px, 0)'
				} else {
					this.thead.style.transform = 'translate3d(0, 0, 0)';
				}

			}.bind(this));
		};

		this.init();
	}
});