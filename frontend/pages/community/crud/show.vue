<template>
	<form-show hide-delete hide-edit with-helpdesk>
		<template
			v-slot:default="{
				combos: { communitymaps, subdistricts, villages },
				record,
				theme,
			}"
		>
			<v-card-text>
				<v-row dense>
					<v-col cols="12">
						<v-combobox
							:items="communitymaps"
							label="Tipe"
							v-model="record.communitymap_id"
							hide-details
							readonly
						></v-combobox>
					</v-col>

					<v-col cols="12">
						<v-combobox
							:items="subdistricts"
							label="Kecamatan"
							v-model="record.subdistrict_id"
							hide-details
							readonly
						></v-combobox>
					</v-col>

					<v-col cols="12">
						<v-combobox
							:items="villages"
							label="Desa"
							v-model="record.village_id"
							hide-details
							readonly
						></v-combobox>
					</v-col>
				</v-row>
			</v-card-text>

			<div class="text-overline pl-4 mt-5">FILE LAMPIRAN</div>

			<v-card-text>
				<v-sheet
					v-if="record.file"
					class="pa-2"
					:color="`${theme}-lighten-4`"
					rounded="pill"
				>
					<div class="d-flex align-center">
						<div class="px-4 flex-grow-1">{{ record.file }}</div>

						<v-btn class="mr-1" :color="theme" size="small" icon>
							<v-icon>cloud_download</v-icon>
						</v-btn>

						<v-btn color="deep-orange" size="small" icon>
							<v-icon>delete</v-icon>
						</v-btn>
					</div>
				</v-sheet>

				<v-row dense v-else>
					<v-col cols="12">
						<v-file-input
							accept="application/pdf"
							label="File SK Lembaga"
							v-model="record.fileraw"
							show-size
						></v-file-input>
					</v-col>

					<v-col cols="12">
						<v-btn
							color="primary"
							block
							variant="flat"
							@click="uploadFile(record, store)"
							>UPLOAD</v-btn
						>
					</v-col>
				</v-row>
			</v-card-text>
		</template>

		<template v-slot:info="{ theme }">
			<div class="text-overline mt-4">Aksi</div>
			<v-divider class="mb-3"></v-divider>

			<v-row>
				<v-col cols="12">
					<v-btn
						:color="theme"
						variant="flat"
						block
						@click="$router.push({ name: 'myfoundation-member' })"
						>daftar anggota</v-btn
					>
				</v-col>
			</v-row>
		</template>
	</form-show>
</template>

<script>
export default {
	name: "myfoundation-community-show",

	methods: {
		uploadFile: function (record) {
			this.$http(`myfoundation/api/community/${record.id}/upload`, {
				method: "POST",
				contentType: "multipart/form-data",
				params: {
					fileraw: record.fileraw,
				},
			}).then(() => {
				this.$router.push({
					name: "mytraining-community",
				});
			});
		},
	},
};
</script>
