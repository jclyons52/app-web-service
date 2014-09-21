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

<h1>Programs</h1>

<form id="addProgram" class="module">
	<div>
		<label for="program_code">Program code: </label>
		<input type="text" id="program_code" name="program_code">
	</div>

	<div>
		<label for="program_name">Program Name: </label>
		<input type="text" id="program_name" name="program_name">
	</div>

	<div>
		<label for="college">College:</label>
		<input type="text" id="college" name="college">
	</div>
	<div>
	</div>
	<div>
		<input type="submit" value="Add Program">
	</div>
</form>

<table id="allPrograms" class="module">
	<thead>
		<tr>
			<td>Program code</td>
			<td>Program Name</td>
			<td>College</td>
			<td>Config</td>
		</tr>
	</thead>
</table>

<div id="editProgram" class="module">

</div>


<script id="allProgramsTemplate" type="text/template">
	<td><%= program_code %></td>
	<td><%= program_name %></td>
	<td><%= college %></td>
	<td><a href="#program/<%= id %>/edit" class="edit">Edit</a></td>
	<td><a href="#program/<%= id %>" class="delete">Delete</a></td>
</script>

<script id="editProgramTemplate" type="text/template">
	<h2>Edit Program: <%= program_code %> <%= program_name %></h2>
	<form id="editProgram">
		<div>
			<label for="edit_program_code">Program code: </label>
			<input type="text" id="edit_program_code" name="edit_program_code" value="<%= program_code %>">
		</div>

		<div>
			<label for="edit_program_name">Program Name: </label>
			<input type="text" id="edit_program_name" name="edit_program_name" value="<%= program_name %>">
		</div>

		<div>
			<label for="edit_college">College:</label>
			<input type="text" id="edit_college" name="edit_college" value="<%= college %>">
		</div>
		<div>
			<input type="submit" value="Add Program">
			<button type="button" class="cancel">Cancel</button>
		</div>
	</form>
</script>

{{ HTML::script('js/jquery.js')}}
{{ HTML::script('js/underscore.js')}}
{{ HTML::script('js/backbone.js')}}
{{ HTML::script('js/programs/main.js')}}
{{ HTML::script('js/programs/models.js')}}
{{ HTML::script('js/programs/collections.js')}}
{{ HTML::script('js/programs/views.js')}}
{{ HTML::script('js/programs/router.js')}}

<script>
	new App.Router;
	Backbone.history.start();

	App.programs = new App.Collections.Programs;
	App.programs.fetch().then(function() {
		new App.Views.App({ collection: App.programs });
	});
</script>

</body>
</html>