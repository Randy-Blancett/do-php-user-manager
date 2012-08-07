Ext.define('darkowl.userManager.group.view.cWindow',
{
    extend : 'darkowl.desktop.cDesktopWindow',
    title : "View Groups",
    requires :
    [ 'darkowl.userManager.group.view.cToolbar',
            'darkowl.userManager.group.view.cGrid' ],
    iconCls : "window-group-view-icon",
    width : 600,
    height : 480,
    shim : false,
    animCollapse : false,
    constrain : true,
    layout : "fit",
    border : false,
    initComponent : function()
    {
	    var obj_This = this;

	    this.m_obj_TopBar = Ext.create(
	            'darkowl.userManager.group.view.cToolbar',
	            {
		            dock : 'top'
	            });

	    this.m_obj_Grid = Ext.create('darkowl.userManager.group.view.cGrid');

	    this.callParent();
	    
	    this.addDocked(this.m_obj_TopBar);
	    this.add(this.m_obj_Grid);
    },
});
