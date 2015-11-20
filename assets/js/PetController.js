var PetController = {
	
	init: function () {
		PetController.setForm();
		PetController.showList();
	},
	
	setForm: function () {
		var form = document.querySelector('form');
		form.addEventListener('submit', function(event) {
			PetController.addPets(form);
			//it is to avoid form submition
			event.preventDefault();
		});
		PetController.setFocus();
	},
	
	setFocus: function() {
		var inputName = document.getElementById('name');
		inputName.focus();
	},
	
	clearForm: function() {
		var form = document.querySelector('form');
		form.reset();
		PetController.setFocus();
	},
	
	addPets: function(form) {
		var pets = {
			name: form.name.value,
			email: form.email.value,
            telefone: form.telefone.value,
            rua: form.rua.value,
            bairro : form.bairro.value,
            numero: form.numero.value,
            cidade: form.cidade.value
		};
		PetService.add(pets, function(addedTask) {
			PetController.addToHTML(addedTask);
			PetController.clearForm();
		});
	},
	
	deletePets: function(imgDelete) {
		var 
			petsName = imgDelete.dataset.petsname,
			petsId = imgDelete.dataset.petsid;
		
		if(confirm('Are you sure to delete ' + petsName + '?')) {
			PetService.remove(petsId, function(isDeleted) {
				if(isDeleted) {
					$(imgDelete).parents('dl').remove();
				}
			})
		}
	},
	
	showList: function () {
		PetService.getList(function(list) {
			list.forEach(function(pets) {
				PetController.addToHTML(pets);
			});	
		});
	},
	
	addToHTML: function (pets) {
		var
			petsList = document.getElementById('petsList'),
			dl = document.createElement('dl'),
			ddName = PetController.createDD(pets.name, 'name'),
			imgDelete = PetController.createDelete(pets),
			ddEmail = PetController.createDD(pets.email, 'email'),
            ddEndereco = PetController.createDD(pets.endereco, 'endereco'),
            ddTelefone = PetController.createDD(pets.telefone, 'telefone'),
            ddRua = PetController.createDD(pets.rua, 'rua'),
            ddBairo = PetController.createDD(pets.bairro, 'bairro'),
            ddNumero = PetController.createDD(pets.numero, 'numero'),
            ddCidade = PetController.createDD(pets.cidade, 'cidade');
		
		ddName.appendChild(imgDelete);
		
		dl.appendChild(dt);
		dl.appendChild(ddName);
		dl.appendChild(ddEmail);
        dl.appendChild(ddTelefone);
        dl.appendChild(ddRua);
        dl.appendChild(ddBairo);
        dl.appendChild(ddNumero);
        dl.appendChild(ddCidade);
		
		petsList.appendChild(dl);
	},
	
	createImage: function(imageLocation) {
		var img = document.createElement('img');
		img.src = imageLocation;
		return img;
	},
	
	createDD: function(value, className) {
		var dd = document.createElement('dd');
		
		dd.innerHTML = value;
		dd.className = className;
		
		return dd;
	},
	
	createDelete: function(pets) {
		var imgDelete = PetController.createImage('assets/images/delete.gif');
		
		imgDelete.setAttribute('data-Petsid', pets.id);
		imgDelete.setAttribute('data-Petsname', pets.name);
		
		imgDelete.addEventListener('click', function() {
			PetController.deletePets(this);
		});
		
		return imgDelete;
	}

};

//TODO consider to have an HTMLService.js
//initialization
PetController.init();
