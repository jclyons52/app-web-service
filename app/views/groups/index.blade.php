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

<h1>groups</h1>

<form id="addGroup" class="module">
	<div>
		<label for="group_code">group code: </label>
		<input type="text" id="group_code" name="group_code">
	</div>

	<div>
		<label for="program_id">program id: </label>
		<input type="text" id="program_id" name="program_id">
	</div>

	<div>
	</div>
	<div>
		<input type="submit" value="Add group">
	</div>
</form>

<table id="allGroups" class="module">
	<thead>
		<tr>
			<td>group code</td>
			<td>program id</td>
			<td>Config</td>
		</tr>
	</thead>
</table>

<div id="editGroup" class="module">

</div>


<script id="allGroupsTemplate" type="text/template">
	<td><%= group_code %></td>
	<td><%= program_id %></td>
	<td><a href="#group/<%= id %>/edit" class="edit">Edit</a></td>
	<td><a href="#group/<%= id %>" class="delete">Delete</a></td>
</script>

<script id="editGroupTemplate" type="text/template">
	<h2>Edit group: <%= group_code %> <%= program_id %></h2>
	<form id="editGroup">
		<div>
			<label for="edit_group_code">group code: </label>
			<input type="text" id="edit_group_code" name="edit_group_code" value="<%= group_code %>">
		</div>

		<div>
			<label for="edit_program_id">program id: </label>
			<input type="text" id="edit_program_id" name="edit_program_id" value="<%= program_id %>">
		</div>

		<div>
			<input type="submit" value="Add group">
			<button type="button" class="cancel">Cancel</button>
		</div>
	</form>
</script>

{{ HTML::script('js/jquery.js')}}
{{ HTML::script('js/underscore.js')}}
{{ HTML::script('js/backbone.js')}}
{{ HTML::script('js/groups/main.js')}}
{{ HTML::script('js/groups/models.js')}}
{{ HTML::script('js/groups/collections.js')}}
{{ HTML::script('js/groups/views.js')}}
{{ HTML::script('js/groups/router.js')}}

<script>
	new App.Router;
	Backbone.history.start();

	App.groups = new App.Collections.Groups;
	App.groups.fetch().then(function() {
		new App.Views.App({ collection: App.groups });
	});
</script>

</body>
</html>