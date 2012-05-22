Ext.define('darkowl.userManager.module.desktop',
{
    extend : 'darkowl.desktop.module.abs_Module',
    // singleton : true,
    m_str_Name : "User Manager Desktop",
    requires :
    [ 'Ext.data.Store', 'darkowl.userManager.setup.window.cWindow' ],
    constructor : function(config)
    {
	    this.buildGeneralMenu();
	    this.buildSpecialMenu();
    },
    buildSpecialMenu : function()
    {
	    this.m_obj_SpecialStartMenu = new Ext.util.MixedCollection();

	    this.m_obj_SpecialStartMenu.add('Create Tables',
	    {
	        iconCls : "menu-create-db-icon",
	        onClick : function()
	        {
		        desktop.MsgBus.fireEvent(
		                desktop.MsgBus.self.C_STR_EVENT_OPEN_WINDOW, {},
		                'darkowl.userManager.setup.window.cWindow');
	        }
	    });
    },
    buildGeneralMenu : function()
    {
	    // this.m_obj_GeneralStartMenu = new
	    // Ext.util.MixedCollection();
	    //		
	    // this.m_obj_GeneralStartMenu.add('Level 1',
	    // {
	    // submenu : this.buildLevel1()
	    // });
    }
});