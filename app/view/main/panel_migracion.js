Ext.define('MyApp.view.main.panel_migracion', {
	extend: 'Ext.Panel',
	controller: 'grid_controller',
	xtype: 'panel_migracion',
	reference: 'panel_migracion',
	viewModel: {
		stores: {
			listadoServerTarget: {
				type: 'Servidores'
			}
		}
	},
	bbar: {
		items: {
			xtype: 'button',
			text: 'Enviar Cambios',
			listeners: {

				click: 'Enviarcambios'
			}
		}
	},
	layout: {
		type: 'hbox',
		align: 'stretch'
	},
	defaults: {
		frame: true,
		bodyPadding: 5
	},
	items: [{
		xtype: 'grid_procedimientos',
		flex: 5
	}, {
		title: 'Objectos Seleccionados',
		reference: 'gridObjetosSeleccionados',
		xtype: 'grid',
		dockedItems: [{
			xtype: 'toolbar',
			items: [{
				xtype: 'textfield'
			}, {
				editable: false,
				fieldLabel: 'Target Server',
				reference: 'cmbTargetServer',
				xtype: 'combo',
				displayField: 'descripcion',
				valueField: 'id',
				forceSelection: true,
				bind: {
					store: '{listadoServerTarget}'
				},
				value: 1

			}, {
				xtype: 'button',
				text: 'Limpiar',
				listeners: {
					click: 'LimpiarFiltros'
				}
			}]
		}],
		flex: 4,
		store: {
			autoLoad: true,
			type: 'procedimientosmysql'
		},
		columns: [{
			header: 'Base de Datos',
			dataIndex: 'db',
			flex: 1
		}, {
			header: 'Tipo',
			dataIndex: 'type',
			flex: 1
		}, {

			header: 'Nombre',
			dataIndex: 'specific_name',
			flex: 2
		}, {
			header: 'Definidor',
			dataIndex: 'definer',
			flex: 1,
			hidden: true
		}, {
			header: 'Fecha de creacion',
			dataIndex: 'created',
			hidden: true,
			flex: 1
		}, {
			header: 'Fecha de Modificación',
			dataIndex: 'modified',
			hidden: true,
			flex: 1

		}],
		viewConfig: {
			/*plugins: {
				ptype: 'gridviewdragdrop',
				containerScroll: true,
				dragGroup: 'dd-grid-to-grid-group2',
				dropGroup: 'dd-grid-to-grid-group1',


				dropZone: {
					overClass: 'dd-over-gridview'
				}
			},

			listeners: {
				drop: 'onDropGrid2'
			}*/
		}
	}]
});