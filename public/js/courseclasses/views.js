/*
|--------------------------------------------------------------------------
| Global App View
|--------------------------------------------------------------------------
*/
App.Views.App = Backbone.View.extend({
	initialize: function() {
		vent.on('courseClass:edit', this.editCourseClass, this);

		var addCourseClassView = new App.Views.AddCourseClass({ collection: App.courseClasses });

		var allCourseClassesView = new App.Views.CourseClasses({ collection: App.courseClasses }).render();
		$('#allCourseClasses').append(allCourseClassesView.el);
	},

	editCourseClass: function(dourseClass) {
		var editCourseClassView = new App.Views.EditCourseClass({ model: courseClass });
		$('#editCourseClass').html(editCourseClassView.el);
	}
});


/*
|--------------------------------------------------------------------------
| Add CourseClass View
|--------------------------------------------------------------------------
*/
App.Views.AddCourseClass = Backbone.View.extend({
	el: '#addCourseClass',

	initialize: function() {
		this.group_id     	= $('#group_id');
		this.course_id   	= $('#course_id');
		this.day            = $('#day');
		this.start_time     = $('#start_time');
		this.end_time 	    = $('#end_time');
		this.class_location = $('#class_location');
	},

	events: {
		'submit': 'addCourseClass'
	},

	addCourseClass: function(e) {
		e.preventDefault();

		this.collection.create({
			group_id: this.group_id.val(),
			course_id: this.course_id.val(),
			day: this.day.val(),
			start_time: this.start_time.val(),
			end_time: this.end_time.val(),
			class_location: this.class_location.val()
		}, { wait: true });

		this.clearForm();
	},

	clearForm: function() {
		this.group_id.val('');
		this.course_id.val('');
		this.day.val('');
		this.start_time.val('');
		this.end_time.val('');
		this.class_location.val('');
	}
});


/*
|--------------------------------------------------------------------------
| Edit CourseClass View
|--------------------------------------------------------------------------
*/
App.Views.EditCourseClass = Backbone.View.extend({
	template: template('editCourseClassTemplate'),

	initialize: function() {
		this.render();

		this.form = this.$('form');
		this.group_id       = this.form.find('#group_id');
		this.course_id      = this.form.find('#course_id');
		this.day            = this.form.find('#day');
		this.start_time     = this.form.find('#start');
		this.end_time 	    = this.form.find('#end_time');
		this.class_location = this.form.find('#class_location');
	},

	events: {
		'submit form': 'submit',
		'click button.cancel': 'cancel'
	},

	submit: function(e) {
		e.preventDefault();

		this.model.save({
			group_id: this.group_id.val(),
			course_id: this.course_id.val(),
			day: this.day.val(),
			start_time: this.start_time.val(),
			end_time: this.end_time.val(),
			class_location: this.class_location.val(),
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
| All CourseClasses View
|--------------------------------------------------------------------------
*/
App.Views.CourseClasses = Backbone.View.extend({
	tagName: 'tbody',

	initialize: function() {
		this.collection.on('add', this.addOne, this);
	},

	render: function() {
		this.collection.each( this.addOne, this );
		return this;
	},

	addOne: function(courseClass) {
		var courseClassView = new App.Views.CourseClass({ model: courseClass });
		this.$el.append(courseClassView.render().el);
	}
});


/*
|--------------------------------------------------------------------------
| Single CourseClass View
|--------------------------------------------------------------------------
*/
App.Views.CourseClass = Backbone.View.extend({
	tagName: 'tr',

	template: template('allCourseClassesTemplate'),

	initialize: function() {
		this.model.on('destroy', this.unrender, this);
		this.model.on('change', this.render, this);
	},

	events: {
		'click a.delete': 'deleteCourseClass',
		'click a.edit'  : 'editCourseClass'
	},

	editCourseClass: function() {
		vent.trigger('CourseClass:edit', this.model);
	},

	deleteCourseClass: function() {
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