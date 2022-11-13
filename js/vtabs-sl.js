(function ($) {
    'use strict';
    $(function () { 
        var timeout = null;
        var vtCOWrapID = '#abcfslVTCNWrapID';
        var vtCOCntCntrID = '#abcfslVTCNCntCntrID';
        var storageKeyCO = 'abcfslStorageKeyCO';

        var vtFWrapID = '#abcfslVTFWrapID';
        var vtFCntCntrID = '#abcfslVTFCntCntrID';
        var storageKeyF = 'abcfslStorageKeyF';
        //--------------------------------------------
        var vtGrpOptns_WrapID = '#abcfslGrpOptns_VTabsCntrID';
        var vtGrpOptns_CntCntrID = '#abcfslGrpOptns_CntCntrID';
        var storageKey_GrpOptns = 'abcfslGrpOptns_StorageKey';

        var vtlMTFOptns_WrapID = '#abcfslMTFOptns_VTabsCntrID';
        var vtMTFOptns_CntCntrID = '#abcfslMTFOptns_CntCntrID';
        var storageKey_MTFOptns = 'abcfslMTFOptns_StorageKey';

        var vtCatMenusOptns_WrapID = '#abcfslCatMenusOptns_VTabsCntrID';
        var vtCatMenusOptns_CntCntrID = '#abcfslCatMenusOptns_CntCntrID';
        var storageKey_CatMenusOptns = 'abcfslCatMenusOptns_StorageKey';

        var vtAZMenusOptns_WrapID = '#abcfslAZMenusOptns_VTabsCntrID';
        var vtAZMenusOptns_CntCntrID = '#abcfslAZMenusOptns_CntCntrID';
        var storageKey_AZMenusOptns = 'abcfslAZMenusOptns_StorageKey';

        var vtActiveCls = 'abcflVTabsTabActive';
        //--------------------------------------------
        // Wrapper for the Navigation Tabs 
        var vtTOWrap = $(vtCOWrapID).children('.abcflVTabsNavCntr'), tabIndex1 = null;
        var vtFWrap = $(vtFWrapID).children('.abcflVTabsNavCntr'), tabIndex1 = null;

        var vtGrpOptns_Wrap = $(vtGrpOptns_WrapID).children('.abcflVTabsNavCntr'), tabIndex1 = null;
        var vtlMTFOptns_Wrap = $(vtlMTFOptns_WrapID).children('.abcflVTabsNavCntr'), tabIndex1 = null;
        var vtCatMenusOptns_Wrap = $(vtCatMenusOptns_WrapID).children('.abcflVTabsNavCntr'), tabIndex1 = null;
        var vtAZMenusOptns_Wrap = $(vtAZMenusOptns_WrapID).children('.abcflVTabsNavCntr'), tabIndex1 = null;
        //--------------------------------------------
        var savedCOTab = sessionStorage.getItem(storageKeyCO);
        //console.log('storageKeyCO');
        //console.log(savedCOTab);
        var savedFTab = sessionStorage.getItem(storageKeyF);
        var savedGrpOptnsTab = sessionStorage.getItem(storageKey_GrpOptns);
        var savedMTFOptnsTab = sessionStorage.getItem(storageKey_MTFOptns);
        var savedCatMenusOptnsTab = sessionStorage.getItem(storageKey_CatMenusOptns);
        var savedAZMenusOptnsTab = sessionStorage.getItem(storageKey_AZMenusOptns);
        //--------------------------------------------
        if(savedCOTab){
            if(savedCOTab != 'CN1'){ $(vtCOWrapID + ' ul.abcflVTabsNavCntr li#CN1').removeClass(vtActiveCls);}
            $(vtCOWrapID + ' ul.abcflVTabsNavCntr li#' + savedCOTab).addClass(vtActiveCls);
            // Hide the old active content
            $(vtCOCntCntrID).children('div:not( .inside.hidden )').addClass('hidden');
            // Display the new content
            $(vtCOCntCntrID + ' #' + savedCOTab) .removeClass('hidden');
        }

        if(savedFTab){
            if(savedFTab != 'F1'){ $(vtFWrapID + ' ul.abcflVTabsNavCntr li#F1').removeClass(vtActiveCls);}
            $(vtFWrapID + ' ul.abcflVTabsNavCntr li#' + savedFTab).addClass(vtActiveCls);
            // Hide the old active content
            $(vtFCntCntrID).children('div:not( .inside.hidden )').addClass('hidden');
            // Display the new content
            $(vtFCntCntrID + ' #' + savedFTab) .removeClass('hidden');
        }
        //--------------------------------------------
        if(savedGrpOptnsTab){
            if(savedGrpOptnsTab != 'CN1'){ $(vtGrpOptns_WrapID + ' ul.abcflVTabsNavCntr li#CN1').removeClass(vtActiveCls);}
            $(vtGrpOptns_WrapID + ' ul.abcflVTabsNavCntr li#' + savedGrpOptnsTab).addClass(vtActiveCls);
            $(vtGrpOptns_CntCntrID).children('div:not( .inside.hidden )').addClass('hidden');
            $(vtGrpOptns_CntCntrID + ' #' + savedGrpOptnsTab) .removeClass('hidden');
        }

        if(savedMTFOptnsTab){
            if(savedMTFOptnsTab != 'CN1'){ $(vtlMTFOptns_WrapID + ' ul.abcflVTabsNavCntr li#CN1').removeClass(vtActiveCls);}
            $(vtlMTFOptns_WrapID + ' ul.abcflVTabsNavCntr li#' + savedMTFOptnsTab).addClass(vtActiveCls);
            $(vtMTFOptns_CntCntrID).children('div:not( .inside.hidden )').addClass('hidden');
            $(vtMTFOptns_CntCntrID + ' #' + savedMTFOptnsTab) .removeClass('hidden');
        }

        if(savedCatMenusOptnsTab){
            if(savedCatMenusOptnsTab != 'CN1'){ $(vtCatMenusOptns_WrapID + ' ul.abcflVTabsNavCntr li#CN1').removeClass(vtActiveCls);}
            $(vtCatMenusOptns_WrapID + ' ul.abcflVTabsNavCntr li#' + savedCatMenusOptnsTab).addClass(vtActiveCls);
            $(vtCatMenusOptns_CntCntrID).children('div:not( .inside.hidden )').addClass('hidden');
            $(vtCatMenusOptns_CntCntrID + ' #' + savedCatMenusOptnsTab) .removeClass('hidden');
        }

        if(savedAZMenusOptnsTab){
            if(savedAZMenusOptnsTab != 'CN1'){ $(vtAZMenusOptns_WrapID + ' ul.abcflVTabsNavCntr li#CN1').removeClass(vtActiveCls);}
            $(vtAZMenusOptns_WrapID + ' ul.abcflVTabsNavCntr li#' + savedAZMenusOptnsTab).addClass(vtActiveCls);
            $(vtAZMenusOptns_CntCntrID).children('div:not( .inside.hidden )').addClass('hidden');
            $(vtAZMenusOptns_CntCntrID + ' #' + savedAZMenusOptnsTab) .removeClass('hidden');
        }
        //===============================================================
        vtTOWrap.children().each(function () {
            $(this).on('click', function (evt) {
                evt.preventDefault();

                //console.log('vtTOWrap');

                // If this tab is not active.
                if (!$(this).hasClass(vtActiveCls)) {

                    // Unmark the current tab and mark the new one as active
                    $('.' + vtActiveCls, vtCOWrapID).removeClass(vtActiveCls);
                    $(this).addClass(vtActiveCls);

                    // Save the index of the tab that's just been marked as active. It will be 0 - 40.
                    tabIndex1 = $(this).index();
                    sessionStorage.setItem(storageKeyCO, this.id);                    

                    // Hide the old active content
                    $(vtCOCntCntrID).children('div:not( .inside.hidden )').addClass('hidden');
                    $(vtCOCntCntrID).children('div:nth-child(' + (tabIndex1) + ')').addClass('hidden');

                    // And display the new content
                    $(vtCOCntCntrID).children('div:nth-child( ' + (tabIndex1 + 1) + ')').removeClass('hidden');

                    $('#sort-items-tbl td').each(function () { $(this).css('width', $(this).width() + 'px'); });
                }
            });
        });

        vtFWrap.children().each(function () {
            $(this).on('click', function (evt) {
                evt.preventDefault();

                //console.log('clicked F');

                if (!$(this).hasClass(vtActiveCls)) {
                    $('.' + vtActiveCls, vtFWrapID).removeClass(vtActiveCls);
                    $(this).addClass(vtActiveCls);
                    tabIndex1 = $(this).index();
                    sessionStorage.setItem(storageKeyF, this.id);                  
                    $(vtFCntCntrID).children('div:not( .inside.hidden )').addClass('hidden');
                    $(vtFCntCntrID).children('div:nth-child(' + (tabIndex1) + ')').addClass('hidden');
                    $(vtFCntCntrID).children('div:nth-child( ' + (tabIndex1 + 1) + ')').removeClass('hidden');             
                }
            });
        });
        //===============================================================
        vtGrpOptns_Wrap.children().each(function () {
            $(this).on('click', function (evt) {
                evt.preventDefault();

                //console.log('clicked vtGrpOptns_Wrap');

                if (!$(this).hasClass(vtActiveCls)) {
                    $('.' + vtActiveCls, vtGrpOptns_WrapID).removeClass(vtActiveCls);
                    $(this).addClass(vtActiveCls);

                    tabIndex1 = $(this).index();
                    sessionStorage.setItem(storageKey_GrpOptns, this.id);                    

                    $(vtGrpOptns_CntCntrID).children('div:not( .inside.hidden )').addClass('hidden');
                    $(vtGrpOptns_CntCntrID).children('div:nth-child(' + (tabIndex1) + ')').addClass('hidden');
                    $(vtGrpOptns_CntCntrID).children('div:nth-child( ' + (tabIndex1 + 1) + ')').removeClass('hidden');
                    $('#sort-items-tbl td').each(function () { $(this).css('width', $(this).width() + 'px'); });
                }
            });
        });

        vtlMTFOptns_Wrap.children().each(function () {
            $(this).on('click', function (evt) {
                evt.preventDefault();

                if (!$(this).hasClass(vtActiveCls)) {
                    $('.' + vtActiveCls, vtlMTFOptns_WrapID).removeClass(vtActiveCls);
                    $(this).addClass(vtActiveCls);

                    tabIndex1 = $(this).index();
                    sessionStorage.setItem(storageKey_MTFOptns, this.id);                    

                    $(vtMTFOptns_CntCntrID).children('div:not( .inside.hidden )').addClass('hidden');
                    $(vtMTFOptns_CntCntrID).children('div:nth-child(' + (tabIndex1) + ')').addClass('hidden');
                    $(vtMTFOptns_CntCntrID).children('div:nth-child( ' + (tabIndex1 + 1) + ')').removeClass('hidden');
                    $('#sort-items-tbl td').each(function () { $(this).css('width', $(this).width() + 'px'); });
                }
            });
        });        
        vtCatMenusOptns_Wrap.children().each(function () {
            $(this).on('click', function (evt) {
                evt.preventDefault();

                if (!$(this).hasClass(vtActiveCls)) {
                    $('.' + vtActiveCls, vtCatMenusOptns_WrapID).removeClass(vtActiveCls);
                    $(this).addClass(vtActiveCls);

                    tabIndex1 = $(this).index();
                    sessionStorage.setItem(storageKey_CatMenusOptns, this.id);                    

                    $(vtCatMenusOptns_CntCntrID).children('div:not( .inside.hidden )').addClass('hidden');
                    $(vtCatMenusOptns_CntCntrID).children('div:nth-child(' + (tabIndex1) + ')').addClass('hidden');
                    $(vtCatMenusOptns_CntCntrID).children('div:nth-child( ' + (tabIndex1 + 1) + ')').removeClass('hidden');
                    $('#sort-items-tbl td').each(function () { $(this).css('width', $(this).width() + 'px'); });
                }
            });
        });        
        vtAZMenusOptns_Wrap.children().each(function () {
            $(this).on('click', function (evt) {
                evt.preventDefault();

                if (!$(this).hasClass(vtActiveCls)) {
                    $('.' + vtActiveCls, vtAZMenusOptns_WrapID).removeClass(vtActiveCls);
                    $(this).addClass(vtActiveCls);

                    tabIndex1 = $(this).index();
                    sessionStorage.setItem(storageKey_AZMenusOptns, this.id);                    

                    $(vtAZMenusOptns_CntCntrID).children('div:not( .inside.hidden )').addClass('hidden');
                    $(vtAZMenusOptns_CntCntrID).children('div:nth-child(' + (tabIndex1) + ')').addClass('hidden');
                    $(vtAZMenusOptns_CntCntrID).children('div:nth-child( ' + (tabIndex1 + 1) + ')').removeClass('hidden');
                    $('#sort-items-tbl td').each(function () { $(this).css('width', $(this).width() + 'px'); });
                }
            });
        });                
    });
})(jQuery);