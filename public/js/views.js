/*
|--------------------------------------------------------------------------
| Global App View
|--------------------------------------------------------------------------
*/
App.Views.App = Backbone.View.extend({
	initialize: function() {
		vent.on('program:edit', this.editProgram, this);

		var addProgramView = new App.Views.AddProgram({ collection: App.programs });

		var allProgramsView = new App.Views.Programs({ collection: App.programs }).render();
		$('#allPrograms').append(allProgramsView.el);
	},

	editProgram: function(program) {
		var editProgramView = new App.Views.EditProgram({ model: program });
		$('#editProgram').html(editProgramView.el);
	}
});


/*
|--------------------------------------------------------------------------
| Add program View
|--------------------------------------------------------------------------
*/
App.Views.AddProgram = Backbone.View.extend({
	el: '#addProgram',

	initialize: function() {
		this.program_code = $('#program_code');
		this.program_name = $('#program_name');
		this.college = $('#college');
	},

	events: {
		'submit': 'addProgram'
	},

	addProgram: function(e) {
		e.preventDefault();

		this.collection.create({
			program_code: this.program_code.val(),
			program_name: this.program_name.val(),
			college: this.college.val(),
		}, { wait: true });

		this.clearForm();
	},

	clearForm: function() {
		this.program_code.val('');
		this.program_name.val('');
		this.college.val('');
	}
});


/*
|--------------------------------------------------------------------------
| Edit Program View
|--------------------------------------------------------------------------
*/
App.Views.EditProgram = Backbone.View.extend({
	template: template('editProgramTemplate'),

	initialize: function() {
		this.render();

		this.form = this.$('form');
		this.program_code = this.form.find('#edit_program_code');
		this.program_name = this.form.find('#edit_program_name');
		this.college = this.form.find('#edit_college');
	},

	events: {
		'submit form': 'submit',
		'click button.cancel': 'cancel'
	},

	submit: function(e) {
		e.preventDefault();

		this.model.save({
			program_code: this.program_code.val(),
			program_name: this.program_name.val(),
			college: this.college.val()
		});

		this.remove();
	},

	cancel: function() {
		this.remove();
	},

	render: function() {
		var html = this.template( this.model.toJSON() );

		this.$el.html(html);
		return this;
	}
});


/*
|--------------------------------------------------------------------------
| All Programs View
|--------------------------------------------------------------------------
*/
App.Views.Programs = Backbone.View.extend({
	tagName: 'tbody',

	initialize: function() {
		this.collection.on('add', this.addOne, this);
	},

	render: function() {
		this.collection.each( this.addOne, this );
		return this;
	},

	addOne: function(program) {
		var programView = new App.Views.Program({ model: program });
		this.$el.append(programView.render().el);
	}
});


/*
|--------------------------------------------------------------------------
| Single Program View
|--------------------------------------------------------------------------
*/
App.Views.Program = Backbone.View.extend({
	tagName: 'tr',

	template: template('allProgramsTemplate'),

	initialize: function() {
		this.model.on('destroy', this.unrender, this);
		this.model.on('change', this.render, this);
	},

	events: {
		'click a.delete': 'deleteProgram',
		'click a.edit'  : 'editProgram'
	},

	editProgram: function() {
		vent.trigger('program:edit', this.model);
	},

	deleteProgram: function() {
		this.model.destroy();
	},

	render: function() {
		this.$el.html( this.template( this.model.toJSON() ) );
		return this;
	},

	unrender: function() {
		this.remove();
	}
});