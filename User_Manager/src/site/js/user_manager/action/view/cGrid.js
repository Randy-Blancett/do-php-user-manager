Ext.define('darkowl.userManager.action.view.cGrid',
{
    extend : 'Ext.grid.Panel',
    requires :
    [ // 'plugin.grid.cSearch',
    'Ext.toolbar.Paging', 'darkowl.userManager.store.cActionList' ],
    columns :
    [
    {
        header : 'ID',
        dataIndex : 'id',
        flex : 1
    },
    {
        header : 'Name',
        dataIndex : 'name',
        flex : 1
    },
    {
        header : 'Application',
        dataIndex : 'application',
        flex : 1
    } ],
    initComponent : function()
    {
	    this.store = Ext.create('darkowl.userManager.store.cActionList');

	    this.m_obj_Pageing = Ext.create("Ext.toolbar.Paging",
	    {
	        store : this.store,
	        dock : 'bottom',
	        displayInfo : true
	    });

	    this.callParent();

	    this.on("beforeload", function()
	    {
		    this.body.mask('Loading', 'x-mask-loading');
	    }, this);

	    this.on("load", function()
	    {
		    this.body.unmask();
	    }, this);

	    this.addDocked(this.m_obj_Pageing);
    }

});