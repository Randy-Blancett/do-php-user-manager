Ext.define('darkowl.userManager.user.view.cGrid',
{
    extend : 'Ext.grid.Panel',
    requires :
    [ // 'plugin.grid.cSearch',
    'Ext.toolbar.Paging', 'darkowl.userManager.store.cUserList' ],
    columns :
    [
    {
        header : 'Name',
        dataIndex : 'name'
    },
    {
        header : 'Email',
        dataIndex : 'email',
        flex : 1
    },
    {
        header : 'Phone',
        dataIndex : 'phone'
    } ],
    initComponent : function()
    {
	    this.store = Ext.create('darkowl.userManager.store.cUserList');
	    

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