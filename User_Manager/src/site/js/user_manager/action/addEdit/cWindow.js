Ext.define('darkowl.userManager.action.addEdit.cWindow',
{
    extend : 'darkowl.desktop.cDesktopWindow',
    title : "Add/Edit Actions",
    requires :
    [ 'darkowl.userManager.action.addEdit.cForm'
    // 'darkowl.userManager.action.view.cGrid'
    ],
    iconCls : "window-action-edit-icon",
    width : 600,
    height : 300,
    shim : false,
    animCollapse : false,
    constrain : true,
    layout : "fit",
    border : false,
    initComponent : function()
    {
	    var obj_This = this;

	    // this.m_obj_TopBar = Ext.create(
	    // 'darkowl.userManager.action.view.cToolbar',
	    // {
	    // dock : 'top'
	    // });
	    //
	    // this.m_obj_Grid =
	    // Ext.create('darkowl.userManager.action.view.cGrid');

	    this.callParent();

	    // this.addDocked(this.m_obj_TopBar);
	    this.add(Ext.create('darkowl.userManager.action.addEdit.cForm'));
    }
});
