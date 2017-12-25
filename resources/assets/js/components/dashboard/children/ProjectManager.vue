<style scoped>
    tr {
    	height: 100px;
    }
	img {
		max-width: 100px;
		max-height: 96px;
		padding: 1rem;
	}
	button:focus, button:active, button:visited {
		outline: none !important;
		box-shadow: none !important;
	}
	td {
		padding-left: 0.5rem;
	}
	.title {
		width: 100%;
	}
	.moveButton {
		margin: 0.05rem;
	}
</style>

<template>

	<div class="col-12 col-lg-6 mb-5 pb-5">

		<div class="card">

			<div class="card-header">
				Projects
			</div>

			<div class="card-body pt-0">
				
				<table>
					<tbody>
					   <tr v-for="(project, key) in projects">
					     <td>
					     	<strong>{{ key + 1 }}</strong>
					     </td>
					     <td>
					     	<button v-if="key > 0" @click.prevent="move(key, key - 1)" class="moveButton btn btn-xs btn-primary"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
					     	<button v-if="key < projects.length - 1" @click.prevent="move(key, key + 1)" class="moveButton btn btn-xs btn-primary"><i class="fa fa-arrow-down" aria-hidden="true"></i></button>
					     </td>
					     <td>
					     	<img :src="getThumbnail(project)" class="project-thumbnail">
					     </td>
					     <td class="title">
					     	{{ project.title_pl }}
					     </td>
					     <td>
					     	<button @click="edit(project)" class="btn btn-sm btn-primary">Edit</button>
					     </td>
					     <td>
					     	<button @click="destroy(project, key)" class="btn btn-sm delete-project">Delete</button>
					     </td>
					   </tr>
					</tbody>
				</table>

			</div>

		</div>

	</div>
	
</template>

<script>
	export default {
		data() {
			return {
				projects: [],
				baseUrl: '',
			}
		},

		created() {
			this.getProjects();
		},

		methods: {
			getProjects() {
				let vm = this;

				axios.get('/project')
					.then(function(response) {
						vm.projects = response.data.projects;
						vm.baseUrl = response.data.baseUrl;
						window.baseUrl = response.data.baseUrl;
					})
					.catch(function(error) {
						console.log(error);
					});
			},

			getThumbnail(project) {
				let projectImages = JSON.parse(project.images);
				let thumbnail = this.baseUrl + '/projects_files/' + projectImages[0];

				return thumbnail;
			},

			edit(project) {
				this.eventHub.$emit('workChanged', {
					newJob: 'projectEdit',
					project: project
				});
			},

			destroy(project, key) {

				if (confirm('Are you sure you want delete it?')) {
					let vm = this;

					axios.delete('/project/' + project.id)
						.then(function(response) {
							console.log(response);
							vm.projects.splice(key, 1);
						})
						.catch(function(error) {
							console.log(error);
						});
				}


			},

			move(from, to) {

				let vm = this;

				axios.post('/backend/move_project', {
						fromId: this.projects[from].id,
						toId: this.projects[to].id
					})
					.then(function(response) {
						console.log(response);
						vm.projects.splice(to, 0, vm.projects.splice(from, 1)[0]);
					})
					.catch(function(error) {
						console.log(error);
					});

			}
		}
	}
</script>