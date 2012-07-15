Ext.define('darkowl.userManager.user.view.cWindow',
{
    extend : 'darkowl.desktop.cDesktopWindow',
    title : "View Users",
    requires :
    [ 'darkowl.userManager.user.view.cToolbar',
            'darkowl.userManager.user.view.cGrid' ],
    iconCls : "window-user-view-icon",
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
	            'darkowl.userManager.user.view.cToolbar',
	            {
		            dock : 'top'
	            });

	    this.m_obj_Grid = Ext.create('darkowl.userManager.user.view.cGrid');

	    this.callParent();

	    this.addDocked(this.m_obj_TopBar);
	    this.add(this.m_obj_Grid);
    },
});
