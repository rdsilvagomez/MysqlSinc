Ext.define('MyApp.store.listadodb', {
    extend: 'Ext.data.Store',

    alias: 'store.listadodb',

    fields: [
        'db'
    ],
    autoLoad: true,
    autoSync: true,
    proxy: {
        type: 'rest',
        url: 'backend/web/index.php/proc/listadodb',
        reader: {
            type: 'json',
            rootProperty: 'data'
        }
    }
});