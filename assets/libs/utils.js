$(function() {
	$.fn.b = function(params) {
		const context = this;
		params.forEach(function(v) {
			const [method, ...params] = v;
			context[method](...params);
		});
		return context;
	}

	$.fn.formToObj = function() {
		try {
			// Ambil form yang dipilih
			var form = this[0];  // `this` adalah objek jQuery, kita ambil elemen pertama (form)
			
			// Buat objek kosong untuk menampung nilai form
			var formData = {};
			
			// Iterasi melalui elemen-elemen form
			for (var i = 0; i < form.elements.length; i++) {
				var element = form.elements[i];
				
				// Periksa apakah elemen memiliki nama (name) dan bukan elemen file
				if (element.name && element.type !== 'file') {
					
					// Menangani checkbox atau radio
					if (element.type === 'checkbox' || element.type === 'radio') {
						// Untuk checkbox dan radio, hanya jika tercentang/terpilih
						if (element.checked) {
							formData[element.name] = element.value;  // Simpan nilai sebagai string
						}
					}
					// Menangani input text, textarea, select
					else if (element.type === 'select-one' || element.type === 'select-multiple') {
						// Jika elemen select, ambil nilai yang dipilih
						var selectedValues = [];
						for (var j = 0; j < element.options.length; j++) {
							var option = element.options[j];
							if (option.selected) {
								selectedValues.push(option.value);
							}
						}
						// Jika ada lebih dari satu nilai, kembalikan sebagai array, jika hanya satu kembalikan sebagai string
						formData[element.name] = selectedValues.length > 1 ? selectedValues : selectedValues[0];
					}
					else {
						// Untuk elemen input lainnya (seperti input text, textarea)
						formData[element.name] = element.value;
					}
				}
			}

			// Kembalikan objek hasil konversi
			return formData;
		} catch (error) {
			// Jika terjadi error, kembalikan objek kosong
			console.error("Error saat mengonversi form:", error);
			return {}; // Mengembalikan objek kosong jika ada error
		}
	};


	$.fn.select2x = function (params) { 
		try {
			let context = this;

			params.xhr = Object.assign({}, {
				url: '',
				type: 'POST',
				dataType: 'json',
				processData: true,
				contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
				dataSrc: 'results',
				data: {},
			}, params.xhr);

			if(typeof params.xhr.onStart=='function') {
				params.xhr.onStart.apply(context);
			}

			$.ajax(params.xhr)
			.done(function(response, textStatus, jqXHR) {
				if(typeof params.xhr.onSuccess=="function") {
					params.xhr.onSuccess.apply(context, [response, textStatus, jqXHR]);
				}
				
				let data = response[params.xhr.dataSrc];
				if(typeof params.placeholder == 'string') data = [{id: "0", text: params.placeholder}].concat(response[params.xhr.dataSrc]);
				params.data = data;
				$(context).empty().select2(params);
			})
			.fail(function(jqXHR, textStatus, errorThrown) {
				if(typeof params.xhr.onFail=='function') {
					params.xhr.onFail.apply(context, [jqXHR, textStatus, errorThrown]);
				}
			})
			.always(function() {
				if(typeof params.xhr.onComplete=='function') {
					params.xhr.onComplete.apply(context);
				}
			});
		} catch (error) {
			console.log(error);
		}

		return this;
	}
	
	$.fn.passwordToggle = function() {
		this.click(function(event){
			event.preventDefault();
			const parent = this.closest(`.input-group`);
			const type = $(`input`, parent).attr('type');
			$(`input`, parent).attr('type', type == `password` ? 'text' : 'password');
			$(`i`, this).prop('className', type == `password` ? 'fa fa-eye-slash' : 'fa fa-eye');
		});
		return this;
	}
	
	$.fn.inputOnlyText = function() {
		this.on('input propertychange', function(e) {
			e.preventDefault();
			this.value = this.value.replace(/[^a-zA-Z\s]/gi, "");
		});
		return this;
	}

	$.fn.inputOnlyNumber = function() {
		this.on('input propertychange', function(e) {
			e.preventDefault();
			this.value = this.value.toLowerCase().replace(/[^0-9]/gi, "") ?? "0";
		});
		return this;
	}

	$.fn.inputIdr = function() {
		this.on('input propertychange', function(e) {
			e.preventDefault();
			let val = this.value.replace(/[^0-9]/gi, '');
			val = Number.parseInt(val);
			val = isNaN(val) ? 0 : val;
			this.value = idr(val);
		});
		return this;
	}

	$.fn.inputUsername = function() {
		this.on('input propertychange', function(e) {
			e.preventDefault();
			this.value = this.value.toLowerCase().replace(/[^0-9a-z]/gi, "");
		});
		return this;
	}

	$.fn.inputEmail = function() {
		this.on('input propertychange', function(e) {
			e.preventDefault();
			this.value = this.value.toLowerCase().replace(/[^0-9a-z\.\@\-]/gi, "");
		});
		return this;
	}

	$.fn.previewImgTo = function(s) {
		this.change(function(event) {
			event.preventDefault();
			try {
				const [file] = this.files;
				const url = URL.createObjectURL(file);
				$(s).prop("src", url);
			} catch(err) {
				console.log(err);
			}
		});
	}

});

function idDateFormat(data) {
	return moment(data).format('DD/MM/YYYY');
}

function unixDateFormat(data) {
	return moment(data, "X").format('DD/MM/YYYY');
}

function idDateTimeFormat(data) {
	return moment(data).format('DD/MM/YYYY HH:mm:ss');
}

function unixDateTimeFormat(data) {
	return moment(data, "X").format('DD/MM/YYYY HH:mm:ss');
}

function idr(angka, prefix="") { 
	const format = Intl.NumberFormat().format(angka).replaceAll(',', '.');
	if(prefix.length>0) {
		return `${prefix} ${format}`;
	} else {
		return format;
	}
}

String.prototype.toHTML = function () {
	const parser = new DOMParser();
	let html = parser.parseFromString(this, 'text/html');
	return html.body.firstChild;
}

HTMLElement.prototype.appendHTML = function (strHtml, register="", ev=false) {
	const parser = new DOMParser();
	let html = parser.parseFromString(strHtml, 'text/html');
	let child = html.body.firstChild;
	if(register.length>0 && typeof ev == 'function' ) {
		child[register] = ev;
	}
	this.append(child);
}