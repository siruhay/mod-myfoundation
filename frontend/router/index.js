export default {
	path: "/myfoundation",
	meta: { requiredAuth: true },
	component: () =>
		import(
			/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/Base.vue"
		),
	children: [
		{
			path: "",
			redirect: { name: "myfoundation-dashboard" },
		},

		{
			path: "dashboard",
			name: "myfoundation-dashboard",
			component: () =>
				import(
					/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/dashboard/index.vue"
				),
		},

		// community
		{
			path: "community",
			component: () =>
				import(
					/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/community/index.vue"
				),
			children: [
				{
					path: "",
					name: "myfoundation-community",
					component: () =>
						import(
							/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/community/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "myfoundation-community-create",
					component: () =>
						import(
							/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/community/crud/create.vue"
						),
				},

				{
					path: ":community/edit",
					name: "myfoundation-community-edit",
					component: () =>
						import(
							/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/community/crud/edit.vue"
						),
				},

				{
					path: ":community/show",
					name: "myfoundation-community-show",
					component: () =>
						import(
							/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/community/crud/show.vue"
						),
				},
			],
		},

		// community
		{
			path: "community/:community/member",
			component: () =>
				import(
					/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/community-member/index.vue"
				),
			children: [
				{
					path: "",
					name: "myfoundation-member",
					component: () =>
						import(
							/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/community-member/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "myfoundation-member-create",
					component: () =>
						import(
							/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/community-member/crud/create.vue"
						),
				},

				{
					path: ":member/edit",
					name: "myfoundation-member-edit",
					component: () =>
						import(
							/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/community-member/crud/edit.vue"
						),
				},

				{
					path: ":member/show",
					name: "myfoundation-member-show",
					component: () =>
						import(
							/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/community-member/crud/show.vue"
						),
				},
			],
		},

		// official
		{
			path: "official",
			component: () =>
				import(
					/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/official/index.vue"
				),
			children: [
				{
					path: "",
					name: "myfoundation-official",
					component: () =>
						import(
							/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/official/crud/data.vue"
						),
				},

				{
					path: "create",
					name: "myfoundation-official-create",
					component: () =>
						import(
							/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/official/crud/create.vue"
						),
				},

				{
					path: ":official/edit",
					name: "myfoundation-official-edit",
					component: () =>
						import(
							/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/official/crud/edit.vue"
						),
				},

				{
					path: ":official/show",
					name: "myfoundation-official-show",
					component: () =>
						import(
							/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/official/crud/show.vue"
						),
				},
			],
		},

		// report
		{
			path: "report",
			name: "myfoundation-report",
			component: () =>
				import(
					/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/report/index.vue"
				),
		},
	],
};
