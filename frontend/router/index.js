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

		// pagename
		// {
		// 	path: "pagename",
		// 	component: () =>
		// 		import(
		// 			/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/pagename/index.vue"
		// 		),
		// 	children: [
		// 		{
		// 			path: "",
		// 			name: "myfoundation-pagename",
		// 			component: () =>
		// 				import(
		// 					/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/pagename/crud/data.vue"
		// 				),
		// 		},

		// 		{
		// 			path: "create",
		// 			name: "myfoundation-pagename-create",
		// 			component: () =>
		// 				import(
		// 					/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/pagename/crud/create.vue"
		// 				),
		// 		},

		// 		{
		// 			path: ":pagename/edit",
		// 			name: "myfoundation-pagename-edit",
		// 			component: () =>
		// 				import(
		// 					/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/pagename/crud/edit.vue"
		// 				),
		// 		},

		// 		{
		// 			path: ":pagename/show",
		// 			name: "myfoundation-pagename-show",
		// 			component: () =>
		// 				import(
		// 					/* webpackChunkName: "myfoundation" */ "@modules/myfoundation/frontend/pages/pagename/crud/show.vue"
		// 				),
		// 		},
		// 	],
		// },
	],
};
