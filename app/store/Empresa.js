Ext.define('MyApp.store.Empresa', {
	extend: 'Ext.data.Store',
	alias: 'store.Empresa',
	fields: ['name'],

	data: [{
		name: 'Tecnoglass',
		codigo: '01'
	}, {
		name: 'Monomeros',
		codigo: '02'
	}, {
		name: 'Olimpica SA',
		codigo: '03'
	}]


});