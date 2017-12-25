<template>
	<div class="d-flex mx-auto">

		<li class="nav-item">
		    <a @click="manageProjects" class="nav-link" href="#">
		        <i class="fa fa-folder-open-o" aria-hidden="true"></i> Projects
		    </a>
		</li>

		<li class="nav-item">
		    <a @click="newProject" class="nav-link" href="#">
		        <i class="fa fa-plus" aria-hidden="true"></i> Add Project
		    </a>
		</li>

		<li class="nav-item">
		    <a @click="firstPageImage" class="nav-link" href="#">
		        <i class="fa fa-picture-o" aria-hidden="true"></i> First Page Image
		    </a>
		</li>


<!-- 		<li class="nav-item dropdown">

		    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		        <i class="fa fa-folder-open-o" aria-hidden="true"></i> Projects
		    </a>
		    <div class="dropdown-menu">
		        <a @click="manageProjects" class="dropdown-item" href="#">Manage Projects</a>
		        <a @click="newProject" class="dropdown-item" href="#">Add new Project</a>
		    </div>

		</li> -->

	</div>
</template>

<script>
	export default {
		methods: {
			manageProjects() {
				this.eventHub.$emit('workChanged', {newJob: 'projectsManage'});
			},

			newProject() {
				this.eventHub.$emit('workChanged', {
					newJob: 'projectCreate',
					project: {},
				});
			},

			welcome() {
				this.eventHub.$emit('workChanged', {newJob: 'cardWelcome'});
			},

			firstPageImage() {
				this.eventHub.$emit('workChanged', {newJob: 'firstPageImage'});
			}
		}
	}
</script>