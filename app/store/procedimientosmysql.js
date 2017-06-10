  Ext.define('MyApp.store.procedimientosmysql', {
    extend: 'Ext.data.Store',
    alias: 'store.procedimientosmysql',
    fields: ['db', 'type', 'specific_name', 'definer', 'created', 'modified', 'serverSourceId', 'serverTargetId'],
    pageSize: 20,
    autoLoad: false,
    autoSync: false,
    proxy: {
      type: 'ajax',
      api: {
        read: 'backend/web/index.php/proc/list',
        update: 'backend/web/index.php/proc/guardar'
      },

      reader: {
        type: 'json',
        rootProperty: 'data',
        totalProperty: '_meta.totalCount'
      },
      writer: {
        type: 'json',
        writeAllFields: true,
        rootProperty: 'data',
        allowSingle: false
      }
    },
    onCreateRecords: function(records, operation, success) {

    },

    onUpdateRecords: function(records, operation, success) {

      if (success === true) {
        ///this.setData([]);

        Ext.MessageBox.show({
          title: 'Status',
          msg: 'Cambios guardados correctamente',
          buttons: Ext.MessageBox.OK,
          icon: Ext.MessageBox['info'.toUpperCase()]
        });
      } else {
        Ext.MessageBox.show({
          title: 'Status',
          msg: 'Error al enviar la solicitud',
          buttons: Ext.MessageBox.OK,
          icon: Ext.MessageBox['error'.toUpperCase()]
        });


      }
    },

    onDestroyRecords: function(records, operation, success) {}


  });