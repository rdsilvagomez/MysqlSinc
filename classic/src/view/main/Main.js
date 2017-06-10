 Ext.define('MyApp.view.main.Main', {
 	extend: 'Ext.tab.Panel',
 	xtype: 'app-main',

 	requires: [
 		'Ext.plugin.Viewport',
 		'Ext.window.MessageBox',
 		'MyApp.view.main.MainController',
 		'MyApp.view.main.MainModel',
 		'MyApp.view.main.List',
 		'MyApp.view.main.grid_controller',
 		'MyApp.view.main.grid_procedimientos',
 		'MyApp.view.main.panel_migracion',
 		'MyApp.view.main.grid_aprobaciones'
 	],
 	controller: 'main',
 	viewModel: 'main',
 	ui: 'navigation',
 	tabBarHeaderPosition: 1,
 	titleRotation: 0,
 	tabRotation: 0,

 	header: {
 		layout: {
 			align: 'stretchmax'
 		},
 		title: {
 			bind: {
 				text: 'Db Sync'
 			},
 			flex: 0
 		},
 		iconCls: 'fa-th-list'
 	},

 	tabBar: {
 		flex: 1,
 		layout: {
 			align: 'stretch',
 			overflowHandler: 'none'
 		}
 	},

 	responsiveConfig: {
 		tall: {
 			headerPosition: 'top'
 		},
 		wide: {
 			headerPosition: 'left'
 		}
 	},

 	defaults: {
 		bodyPadding: 10,
 		tabConfig: {
 			plugins: 'responsive',
 			responsiveConfig: {
 				wide: {
 					iconAlign: 'left',
 					textAlign: 'left'
 				},
 				tall: {
 					iconAlign: 'top',
 					textAlign: 'center'

 				}
 			}
 		}
 	},

 	items: [{
 		title: 'Home',
 		iconCls: 'fa-home',

 		items: [{
 			xtype: 'panel_migracion'
 		}]
 	}, {
 		title: 'Aprobaciones',
 		iconCls: 'fa-user',
 		xtype: 'grid_aprobaciones'
 	}, {
 		title: 'Groups',
 		iconCls: 'fa-users',
 		bind: {
 			html: '{loremIpsum}'
 		}
 	}, {
 		title: 'Settings',
 		iconCls: 'fa-cog',
 		bind: {
 			html: '{loremIpsum}'
 		}
 	}, {
 		title: 'Procedimientos productivo Calidad',
 		iconCls: 'fa-cog',
 		bind: {
 			html: '{loremIpsum}'
 		}
 	}]
 });