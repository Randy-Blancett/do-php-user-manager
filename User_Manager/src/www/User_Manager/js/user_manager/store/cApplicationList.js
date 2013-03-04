Ext.define('darkowl.userManager.store.cApplicationList',
{
    extend : 'Ext.data.Store',

    requires :
    [ 'darkowl.userManager.model.cApplication' ],
    autoLoad : true,
    proxy :
    {
        headers :
        {
	        Accept : "application/json"
        },
        type : 'ajax',
        url : '../rest/application',
        reader :
        {
            totalProperty : 'total',
            type : 'json',
            root : 'applications'
        }
    },
    model : 'darkowl.userManager.model.cApplication'
});