Ext.define('darkowl.userManager.model.cAction',
{
    extend : 'Ext.data.Model',
    fields :
    [
    {
        name : 'id',
        type : 'string'
    },
    {
        name : 'name',
        type : 'string'
    },
    {
        name : 'application',
        type : 'string'
    },
    {
        name : 'applicationName',
        type : 'string'
    },
    {
        name : 'comment',
        type : 'string'
    }]
});