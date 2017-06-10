Ext.define('MyApp.view.main.grid_procedimientos', {
	extend: 'Ext.grid.Panel',
	controller: 'grid_controller',

	title: 'Migracion  Funciones y Procedimientos  Almacenados',
	xtype: 'grid_procedimientos',

	requires: [
		'MyApp.store.procedimientosmysql',
		'Ext.toolbar.Paging',
		'MyApp.store.Servidores'
	],
	viewModel: {
		stores: {
			listadoproc: {
				type: 'procedimientosmysql'
			},
			listadoServer: {
				type: 'Servidores'
			},
			listadoServerTarget: {
				type: 'Servidores'
			}
		}
	},
	viewConfig: {

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
	loadMask: true,
	listeners: {
		rowdblclick: 'rowdblclick'
	},
	dockedItems: [

		{

			xtype: 'toolbar',
			items: [{
					flex: 2,
					editable: false,
					fieldLabel: 'Select Server',
					reference: 'cmbFiltroServer',
					xtype: 'combobox',
					displayField: 'descripcion',
					valueField: 'id',
					forceSelection: true,
					bind: {
						store: '{listadoServer}'
					},
					listeners: {
						select: 'onSeleccionSrv'
					}
				}, {
					editable: false,
					flex: 2,
					fieldLabel: 'Select db',
					reference: 'cmbFiltrobd',
					xtype: 'combobox',

					forceSelection: true,
					store: {
						type: 'listadodb'
					},
					displayField: 'db',
					listeners: {

						select: 'onSeleccionDb'
					}
				},

				{
					flex: 1,
					xtype: 'textfield',
					reference: 'filtroProc',
					listeners: {
						keyup: 'keyup',
						keypress: 'presionar'
					}
				}, {

					flex: 1,
					xtype: 'button',
					text: 'Filtrar',
					listeners: [{
						click: 'FiltrarProcedimientos'

					}]
				}
			]

		}
	],
	bind: {
		store: '{listadoproc}'
	},
	bbar: {
		xtype: 'pagingtoolbar',
		displayInfo: true,
		bind: {
			store: '{listadoproc}'

		}
	}
});