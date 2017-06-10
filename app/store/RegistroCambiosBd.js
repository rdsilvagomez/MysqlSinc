Ext.define('MyApp.store.RegistroCambiosBd', {
	extend: 'Ext.data.Store',
	alias: 'store.RegistroCambiosBd',
	fields: ['id',

		'autorizado', {
			name: 'fechacompleta',
			mapping: 'fecha',
			type: 'string'
		}, {
			name: 'servidorSource',
			mapping: 'servidorOrigen.descripcion'

		}, {
			name: 'servidorTarget',
			mapping: 'servidorDestino.descripcion'
		}, {
			name: 'registroCambioBdDetalles'
		}


	],
	pageSize: 20,
	autoLoad: true,
	autoSync: true,
	proxy: {
		type: 'ajax',
		api: {
			read: 'backend/web/index.php/registrocambiosbd?expand=servidorDestino,servidorOrigen,registroCambioBdDetalles',
			update: 'backend/web/index.php/registrocambiosbd/gentrans',
			write: 'backend/web/index.php/registrocambiosbd/gentrans'
		},
		reader: {
			type: 'json',
			rootProperty: 'data',
			totalProperty: '_meta.totalCount'
		},
		writer: {
			type: 'json',
			writeAllFields: true,
			root: 'data',
			allowSingle: false
		}

	},
	onUpdateRecords: function(records, operation, success) {

		if (success === true) {


			Ext.MessageBox.show({
				title: 'Status',
				msg: 'Cambios guardados correctamente',
				buttons: Ext.MessageBox.OK,
				icon: Ext.MessageBox['info'.toUpperCase()]
			});
		} else {
			Ext.MessageBox.show({
				title: 'Status',
				msg: 'Error al enviar la solicitud',
				buttons: Ext.MessageBox.OK,
				icon: Ext.MessageBox['error'.toUpperCase()]
			});

		}
	}
});