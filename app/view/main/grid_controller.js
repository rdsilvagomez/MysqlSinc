Ext.define('MyApp.view.main.grid_controller', {
	extend: 'Ext.app.ViewController',
	alias: 'controller.grid_controller',
	GenerarAprobacionCambios: function(btn) {

	},
	LimpiarFiltros: function(btn) {
		this.lookupReference('gridObjetosSeleccionados').getStore().loadData([]);
	},
	Enviarcambios: function(btn) {
		var selectedSourceId = this.getView().down('grid_procedimientos').lookupReference('cmbFiltroServer').value;
		var selectedTargetId = this.lookupReference('cmbTargetServer').value;
		Ext.Msg.confirm('Alerta', 'Desea enviar esta solicitud?',
			function(btn) {
				if (btn === 'yes') {
					this.lookupReference('gridObjetosSeleccionados').getStore().each(function(record) {
						record.set('serverSourceId', selectedSourceId);
						record.set('serverTargetId', selectedTargetId);
					});
					this.lookupReference('gridObjetosSeleccionados').getStore().sync();
				}
			}, this);
	},
	cargarInformacionFunciones: function() {
		var grid = this.getView()
		var store = grid.getStore();
		store.proxy.extraParams = {
			db: grid.lookupReference('cmbFiltrobd').value,
			serverid: grid.lookupReference('cmbFiltroServer').value,
			nombre_proc: grid.lookupReference('filtroProc').value
		};
		store.load();
	},
	GenerarTransporte: function(grid, record, tr, rowIndex, e, eOpts) {
		Ext.Msg.confirm('Alert', 'Desea enviar esta solicitud?',
			function(btn) {
				if (btn == 'yes') {
					record.set('autorizado', 1);
				}
			}
		);
	},
	onSeleccionSrv: function(combo, record, eOpts) {

		var view = this.getView();
		cmb = view.lookupReference('cmbFiltrobd');
		var store = cmb.getStore();
		store.proxy.extraParams = {
			serverid: combo.value
		};
		store.load();
		view.getStore().setData([]);
		view.up().lookupReference('gridObjetosSeleccionados').getStore().setData([]);
	},

	presionar: function(e, t, eOpts) {

	},
	CargarDetalleAprobacion: function(grid, record, tr, rowIndex, e, eOpts) {
		alert('cargar detalle aprobacion');
	},
	rowdblclick: function(grid, record, tr, rowIndex, e, eOpts) {
		var view = this.getView();
		record.set('created', '');
		record.set('serverSourceId', view.lookupReference('cmbFiltroServer').value);
		this.getView().up().lookupReference('gridObjetosSeleccionados').getStore().insert(0, record);
	},
	FiltrarProcedimientos: function(btn) {

		this.cargarInformacionFunciones();

	},
	keyup: function(txt, e, eOpts) {

	},
	onSeleccionDb: function(combo, record, eOpts) {
		this.cargarInformacionFunciones();

	},
	onDropGrid1: function(node, data, dropRec, dropPosition) {
		return;
	},

	onDropGrid2: function(node, data, dropRec, dropPosition) {
		return;
	},

});