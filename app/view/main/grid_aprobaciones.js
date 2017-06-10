/*Panel aprobaciones en la base de datos*/
Ext.define('MyApp.view.main.grid_aprobaciones', {
	extend: 'Ext.Panel',
	controller: 'grid_controller',
	xtype: 'grid_aprobaciones',
	title: 'Aprobaciones',
	referenceHolder: true,
	viewModel: true,
	requires: ['MyApp.store.RegistroCambiosBd', 'Ext.toolbar.Paging'],
	viewModel: {
		stores: {
			listadoAprobaciones: {
				type: 'RegistroCambiosBd'
			}
		}
	},
	layout: {
		type: 'vbox',
		align: 'stretch'
	},
	/*bbar: [{
		xtype: 'button',
		text: 'Enviar Cambios',
		listeners: {
			click: 'GenerarAprobacionCambios'
		}
	}],*/

	items: [{
			xtype: 'grid',
			title: 'Aprobaciones',
			reference: 'gridAprobaciones',
			flex: 1,
			listeners: {
				rowdblclick: 'GenerarTransporte'
			},
			bind: {
				store: '{listadoAprobaciones}'
			},

			bbar: {
				xtype: 'pagingtoolbar',
				displayInfo: true,
				bind: {
					store: '{listadoAprobaciones}'

				}
			},

			columns: [{
				header: 'id',
				dataIndex: 'id',
				flex: 1
			}, {
				header: 'fecha',
				dataIndex: 'fechacompleta',
				flex: 1
			}, {
				header: 'Servidor Origen',
				dataIndex: 'servidorSource',
				flex: 1
			}, {
				header: 'Servidor Destino',
				dataIndex: 'servidorTarget',
				flex: 1
			}, {
				header: 'autorizado',
				dataIndex: 'autorizado',
				flex: 1
			}, {
				xtype: 'actioncolumn',
				items: [{
					iconCls: 'array-grid-sell-col'
				}]
			}]

		}, {
			xtype: 'grid',

			title: 'Detalle Aprobaciones',
			bind: {

				store: {
					data: '{gridAprobaciones.selection.registroCambioBdDetalles}',
				}

			},
			flex: 1,
			columns: [{
				header: 'Base de Datos',
				dataIndex: 'bd',
				flex: 1
			}, {
				header: 'Tipo',
				dataIndex: 'TipoObjeto',
				flex: 1
			}, {

				header: 'Nombre',
				dataIndex: 'nombre',
				flex: 2
			}, {
				header: 'Fecha',
				dataIndex: 'fecha',
				hidden: true,
				flex: 1
			}],
			bbar: {
				xtype: 'pagingtoolbar',
				displayInfo: true
			}
		}

	]



});