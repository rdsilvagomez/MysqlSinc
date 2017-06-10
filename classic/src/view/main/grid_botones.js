 Ext.define('MyApp.view.main.grid_botones', {
 	extend: 'Ext.grid.Panel',
 	controller: 'grid_controller',

 	requires: [
 		'MyApp.store.Empresa'
 	],

 	title: 'Listado de Empresa',

 	store: {
 		type: 'Empresa'
 	},

 	columns: [{
 		text: 'Name',
 		dataIndex: 'name'
 	}, {
 		text: 'Codigo',
 		dataIndex: 'codigo'
 	}],



 	dockedItems: [{
 		xtype: 'toolbar',
 		dock: 'bottom',
 		ui: 'footer',
 		layout: {
 			pack: 'center'
 		},
 		items: [{
 			minWidth: 80,
 			text: 'Save'
 		}, {
 			minWidth: 80,
 			text: 'Cancel'
 		}]
 	}, {
 		xtype: 'toolbar',
 		items: [{
 			reference: 'fooGrid',

 			text: 'Add Something',
 			tooltip: 'Add a new row',
 			listeners: {
 				click: 'onLoginClick'
 			}

 		}, '-', {
 			text: 'Options',
 			tooltip: 'Set options'

 		}, '-', {
 			reference: 'removeButton', // The referenceHolder can access this button by this name
 			text: 'Remove Something',
 			tooltip: 'Remove the selected item',
 			disabled: true
 		}]
 	}]


 });