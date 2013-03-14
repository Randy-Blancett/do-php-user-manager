Ext.define('darkowl.userManager.model.cUser',
{
    extend : 'Ext.data.Model',
    fields :
    [
    {
        name : 'id',
        type : 'string'
    },
    {
        name : 'firstName',
        type : 'string'
    },
    {
        name : 'lastName',
        type : 'string'
    },
    {
        name : 'middleName',
        type : 'string'
    },
    {
        name : 'personalTitle',
        type : 'string'
    },
    {
        name : 'professionalTitle',
        type : 'string'
    },
    {
        name : 'userName',
        type : 'string'
    } ]
});