 Ext.define('MyApp.view.main.List', {
     extend: 'Ext.grid.Panel',
     xtype: 'mainlist',

     requires: [
         'MyApp.store.listadodb'
     ],

     title: 'Listado Base de datos',

     store: {
         type: 'listadodb'
     },

     columns: [{
         flex: 1,
         text: 'Name',
         dataIndex: 'db'
     }],

     listeners: {
         select: 'onItemSelected'
     },
     dockedItems: [{
         xtype: 'toolbar',
         items: [{
             xtype: 'combobox',
             store: {
                 type: 'listadodb'
             },
             displayField: 'db',
             text: 'Add Something',
             tooltip: 'Add a new row',
             iconCls: 'framing-buttons-add',
             listeners: {
                 select: 'onSeleccionDb'
             }
         }]
     }]
 });