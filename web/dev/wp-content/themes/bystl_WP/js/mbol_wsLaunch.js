var iframeElem; // global scope

function initMbolModal() { 

    var d, rootElm, vpw, vph, modalHeight, modalWidth, iframeHeight, frameVshift, frameHeight;

    d = document; 
    rootElm = (d.documentElement && d.compatMode == 'CSS1Compat') ? d.documentElement : d.body; 
    vpw = self.innerWidth ? self.innerWidth : rootElm.clientWidth; // viewport width 
    vph = self.innerHeight ? self.innerHeight : rootElm.clientHeight; // viewport height 

    modalHeight = vph * .95;
    if(modalHeight > 600) {
        modalHeight = 600;
    }

    modalWidth = vpw * .95;
    if(modalWidth > 795) {
        modalWidth = 795;
    }


    // how far are we moving the frame up to hide the header?
    frameVshift = 216;
    frameHeight = modalHeight + frameVshift - 15;
    frameHeight = frameHeight.toString() + "px";

    //console.info("vpw: " + vpw + "\nvph: " + vph + "\nmodalWidth: " + modalWidth + "\nmodalHeight: " + modalHeight);

    $(mbolModalElem).css({
        height: modalHeight,
        width: modalWidth,
        left: ((vpw - modalWidth) / 2) + 'px',
        top: (rootElm.scrollTop + (vph - modalHeight)/2 ) + 'px',
        margin: 0
    });

    $(mbolModalElem).find(".modal-body").css({
        height: modalHeight
    });

    if(launched == false) {
        // haven't launched yet... 
        // set the dimensions AND show the modal
        launchMbolModal(frameHeight);    
    } else {
        // modal is already showing
        // just change the dimensions when this is triggered.
        $(iframeElem).attr("height",frameHeight);
    }
    
    // console.info("frameHeight: " + frameHeight);
    // $(mbolModalElem).find(".modal-body > iframe").height(frameHeight);

}

function launchMbolModal(frameHeight) {
    var mbolHTML = "<iframe id='innerFrame' src='" + modalURL + "' class='" + screenClass + "' width='100%' height='" + frameHeight + "' frameborder='0' scrolling='no' allowtransparency='true'></iframe>";
    // put the iframe window in the modal body
    $(mbolModalElemID + " .modal-body").html(mbolHTML);
    iframeElem = $("#innerFrame");
}