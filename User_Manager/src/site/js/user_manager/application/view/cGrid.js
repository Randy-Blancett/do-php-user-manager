Ext.define('darkowl.userManager.application.view.cGrid',
{
    extend : 'Ext.grid.Panel',
    requires :
    [ // 'plugin.grid.cSearch',
    'Ext.toolbar.Paging', 'darkowl.userManager.store.cApplicationList' ],
    columns :
    [
    {
        header : 'ID',
        dataIndex : 'userName'
    },
    {
        header : 'Name',
        dataIndex : 'firstName',
        flex : 1
    }],
    initComponent : function()
    {
	    this.store = Ext.create('darkowl.userManager.store.cApplicationList');

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