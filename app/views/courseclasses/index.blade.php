<!doctype html>
<html>
<head>
	<title></title>
	<style>
	table thead td { font-weight: bold; }
	.module { margin-bottom: 2em; }
	</style>
</head>
<body>

<h1>CourseClasses</h1>

<form id="addCourseClass" class="module">
	<div>
		<label for="group_id">group id: </label>
		<input type="text" id="group_id" name="group_id">
	</div>

	<div>
		<label for="course_id">course id: </label>
		<input type="text" id="course_id" name="course_id">
	</div>

	<div>
		<label for="day">day: </label>
		<input type="text" id="day" name="day">
	</div>

	<div>
		<label for="start_time">start_time: </label>
		<input type="text" id="start_time" name="start_time">
	</div>

	<div>
		<label for="end_time">end_time: </label>
		<input type="text" id="end_time" name="end_time">
	</div>

	<div>
		<label for="class_location">class_location:</label>
		<input type="text" id="class_location" name="class_location">
	</div>
	<div>
	</div>
	<div>
		<input type="submit" value="Add CourseClass">
	</div>
</form>

<table id="allCourseClasses" class="module">
	<thead>
		<tr>
			<td>group_id</td>
			<td>course_id</td>
			<td>day</td>
			<td>start_time</td>
			<td>end_time</td>
			<td>class_location</td>
		</tr>
	</thead>
</table>

<div id="editCourseClass" class="module">

</div>


<script id="allCourseClassesTemplate" type="text/template">
	<td><%= group_id %></td>
	<td><%= course_id %></td>
	<td><%= day %></td>
	<td><%= start_time %></td>
	<td><%= end_time %></td>
	<td><%= class_location %></td>
	<td><a href="#CourseClass/<%= id %>/edit" class="edit">Edit</a></td>
	<td><a href="#CourseClass/<%= id %>" class="delete">Delete</a></td>
</script>

<script id="editCourseClassTemplate" type="text/template">
	<h2>Edit CourseClass: <%= CourseClass_code %> <%= CourseClass_name %></h2>
	<form id="editCourseClass">
		<div>
			<label for="edit_group_id">group_id: </label>
			<input type="text" id="edit_group_id" name="edit_group_id" value="<%= group_id %>">
		</div>

		<div>
			<label for="edit_course_id">course_id: </label>
			<input type="text" id="edit_course_id" name="edit_course_id" value="<%= course_id %>">
		</div>

		<div>
			<label for="edit_day">day:</label>
			<input type="text" id="edit_day" name="edit_day" value="<%= day %>">
		</div>

		<div>
			<label for="edit_start_time">start_time: </label>
			<input type="text" id="edit_start_time" name="edit_start_time" value="<%= start_time %>">
		</div>

		<div>
			<label for="edit_end_time">end_time: </label>
			<input type="text" id="edit_end_time" name="edit_end_time" value="<%= end_time %>">
		</div>

		<div>
			<label for="edit_class_location">class_location:</label>
			<input type="text" id="edit_class_location" name="edit_class_location" value="<%= class_location %>">
		</div>

		<div>
			<input type="submit" value="Add CourseClass">
			<button type="button" class="cancel">Cancel</button>
		</div>
	</form>
</script>

{{ HTML::script('js/jquery.js')}}
{{ HTML::script('js/underscore.js')}}
{{ HTML::script('js/backbone.js')}}
{{ HTML::script('js/courseclasses/main.js')}}
{{ HTML::script('js/courseclasses/models.js')}}
{{ HTML::script('js/courseclasses/collections.js')}}
{{ HTML::script('js/courseclasses/views.js')}}
{{ HTML::script('js/courseclasses/router.js')}}

<script>
	new App.Router;
	Backbone.history.start();

	App.courseClasses = new App.Collections.CourseClasses;
	App.courseClasses.fetch().then(function() {
		new App.Views.App({ collection: App.courseClasses });
	});
</script>

</body>
</html>