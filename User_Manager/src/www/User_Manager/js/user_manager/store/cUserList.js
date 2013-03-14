Ext.define('darkowl.userManager.store.cUserList',
{
    extend : 'Ext.data.Store',

    requires :
    [ 'darkowl.userManager.model.cUser' ],
    autoLoad : true,
    proxy :
    {
        headers :
        {
	        Accept : "application/json"
        },
        type : 'ajax',
        url : '../rest/user',
        reader :
        {
            totalProperty : 'total',
            type : 'json',
            root : 'users'
        }
    },
    model : 'darkowl.userManager.model.cUser'
});