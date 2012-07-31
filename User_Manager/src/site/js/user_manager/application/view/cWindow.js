Ext.define('darkowl.userManager.application.view.cWindow',
{
    extend : 'darkowl.desktop.cDesktopWindow',
    title : "View Applications",
    requires :
    [ 'darkowl.userManager.application.view.cToolbar',
            'darkowl.userManager.application.view.cGrid' ],
    iconCls : "window-application-view-icon",
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
	            'darkowl.userManager.application.view.cToolbar',
	            {
		            dock : 'top'
	            });

	    this.m_obj_Grid = Ext
	            .create('darkowl.userManager.application.view.cGrid');

	    this.callParent();

	    this.addDocked(this.m_obj_TopBar);
	    this.add(this.m_obj_Grid);
    },
});
