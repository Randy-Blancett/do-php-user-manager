Ext.define('darkowl.userManager.login.cLoginWin',
{
    extend : 'Ext.window.Window',
    requires :
    [ "darkowl.userManager.login.cLoginForm" ],
    title : 'Login',
    closable : false,
    iconCls : "window-login-icon",
    animCollapse : false,
    autoWidth : true,
    autoHeight : true,
    layout : 'fit',
    initComponent : function()
    {
	    this.m_obj_Form = Ext.create("darkowl.userManager.login.cLoginForm",
	    {
		    id : "LoginForm"
	    });
	    var obj_Map = Ext.create('Ext.util.KeyMap', Ext.getDoc(),
	    {
	        key :
	        [ 10, 13 ],
	        fn : function()
	        {
		        this.m_obj_Form.submit();
	        },
	        scope : this
	    });
	    this.items =
	    [ this.m_obj_Form ]
	    this.callParent();
    }
});
