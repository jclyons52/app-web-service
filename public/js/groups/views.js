/*
|--------------------------------------------------------------------------
| Global App View
|--------------------------------------------------------------------------
*/
App.Views.App = Backbone.View.extend({
	initialize: function() {
		vent.on('group:edit', this.editGroup, this);

		var addGroupView = new App.Views.AddGroup({ collection: App.groups });

		var allGroupsView = new App.Views.Groups({ collection: App.groups }).render();
		$('#allGroups').append(allGroupsView.el);
	},

	editGroup: function(group) {
		var editGroupView = new App.Views.EditGroup({ model: group });
		$('#editGroup').html(editGroupView.el);
	}
});


/*
|--------------------------------------------------------------------------
| Add group View
|--------------------------------------------------------------------------
*/
App.Views.AddGroup = Backbone.View.extend({
	el: '#addGroup',

	initialize: function() {
		this.group_code = $('#group_code');
		this.program_id = $('#program_id');
	},

	events: {
		'submit': 'addGroup'
	},

	addGroup: function(e) {
		e.preventDefault();

		this.collection.create({
			group_code: this.group_code.val(),
			program_id: this.program_id.val(),
		}, { wait: true });

		this.clearForm();
	},

	clearForm: function() {
		this.group_code.val('');
		this.program_id.val('');
	}
});


/*
|--------------------------------------------------------------------------
| Edit group View
|--------------------------------------------------------------------------
*/
App.Views.EditGroup = Backbone.View.extend({
	template: template('editGroupTemplate'),

	initialize: function() {
		this.render();

		this.form = this.$('form');
		this.group_code = this.form.find('#edit_group_code');
		this.program_id = this.form.find('#edit_program_id');
	},

	events: {
		'submit form': 'submit',
		'click button.cancel': 'cancel'
	},

	submit: function(e) {
		e.preventDefault();

		this.model.save({
			group_code: this.group_code.val(),
			program_id: this.program_id.val(),
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
| All groups View
|--------------------------------------------------------------------------
*/
App.Views.Groups = Backbone.View.extend({
	tagName: 'tbody',

	initialize: function() {
		this.collection.on('add', this.addOne, this);
	},

	render: function() {
		this.collection.each( this.addOne, this );
		return this;
	},

	addOne: function(group) {
		var groupView = new App.Views.Group({ model: group });
		this.$el.append(groupView.render().el);
	}
});


/*
|--------------------------------------------------------------------------
| Single Group View
|--------------------------------------------------------------------------
*/
App.Views.Group = Backbone.View.extend({
	tagName: 'tr',

	template: template('allGroupsTemplate'),

	initialize: function() {
		this.model.on('destroy', this.unrender, this);
		this.model.on('change', this.render, this);
	},

	events: {
		'click a.delete': 'deleteGroup',
		'click a.edit'  : 'editGroup'
	},

	editGroup: function() {
		vent.trigger('group:edit', this.model);
	},

	deleteGroup: function() {
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