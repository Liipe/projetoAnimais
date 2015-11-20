var PetService = {

	list: [],
	
	add: function(pets, callback) {
		$.ajax({
			type: 'POST',
			contentType: 'application/json',
			url: 'api/pets/',
			data: JSON.stringify(pets),
			success: function(addedTask) {
				console.log('Task pet created!');
				callback(addedTask);
			},
			error: function() {
				console.log('Error to add task pet ' + pets.name);
			}
		});
	},
	
	remove: function(id, callback) {
		$.ajax({
			type: 'DELETE',
			url: 'api/pets/' + id,
			success: function(response) {
				console.log('Task pet deleted!');
				callback(true);
			},
			error: function(jqXHR) {
				console.log('Error to delete task with id ' + id);
				callback(false);
			}
		});
	},
    
	
	getList: function(callback) {
		$.ajax({
			type: 'GET',
			url: 'api/pets/',
			dataType: 'json',
			success: function(list) {
				callback(list);
			}
		});
	}
}
