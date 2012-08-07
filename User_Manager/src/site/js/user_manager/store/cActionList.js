Ext.define('darkowl.userManager.store.cActionList',
{
    extend : 'Ext.data.Store',

    requires :
    [ 'darkowl.userManager.model.cAction' ],
    autoLoad : true,
    proxy :
    {
        headers :
        {
	        Accept : "application/json"
        },
        type : 'ajax',
        url : '../rest/action',
        reader :
        {
            totalProperty : 'total',
            type : 'json',
            root : 'actions'
        }
    },
    model : 'darkowl.userManager.model.cAction'
});