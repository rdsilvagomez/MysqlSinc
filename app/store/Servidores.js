Ext.define('MyApp.store.Servidores', {
	extend: 'Ext.data.Store',
	alias: 'store.Servidores',
	fields: ['id', 'descripcion'],
	autoLoad: true,
	autoSync: true,
	proxy: {
		type: 'ajax',
		api: {
			read: 'backend/web/index.php/servidoresbd'
		},
		reader: {
			type: 'json',
			rootProperty: 'data'
		}
	}

});