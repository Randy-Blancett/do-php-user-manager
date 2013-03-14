Ext.define('darkowl.userManager.store.cGroupList',
{
    extend : 'Ext.data.Store',

    requires :
    [ 'darkowl.userManager.model.cGroup' ],
    autoLoad : true,
    proxy :
    {
        headers :
        {
	        Accept : "application/json"
        },
        type : 'ajax',
        url : '../rest/group',
        reader :
        {
            totalProperty : 'total',
            type : 'json',
            root : 'groups'
        }
    },
    model : 'darkowl.userManager.model.cGroup'
});