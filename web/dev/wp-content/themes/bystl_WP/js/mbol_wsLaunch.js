function centerMbolModal() { 

    console.info("resize");

    function putInCenter(elemID) { 
        var d = document; 
        var rootElm = (d.documentElement && d.compatMode == 'CSS1Compat') ? d.documentElement : d.body; 
        var vpw = self.innerWidth ? self.innerWidth : rootElm.clientWidth; // viewport width 
        var vph = self.innerHeight ? self.innerHeight : rootElm.clientHeight; // viewport height 

        var modalHeight = vph * .8;
        var modalWidth = vpw * .8;
        if(modalWidth > 784) {
            modalWidth = 784;
        }

        //console.info("vpw: " + vpw + "\nvph: " + vph + "\nmodalWidth: " + modalWidth + "\nmodalHeight: " + modalHeight);

        $(elemID).css({
            height: modalHeight,
            width: modalWidth,
            left: ((vpw - modalWidth) / 2) + 'px',
            top: (rootElm.scrollTop + (vph - modalHeight)/2 ) + 'px',
            margin: 0
        });

        $(elemID).find(".modal-body").css({
            height: modalHeight
        });

        // myDiv.style.position = 'absolute'; 
        // myDiv.style.left = ((vpw - 100) / 2) + 'px';  
        // myDiv.style.top = (rootElm.scrollTop + (vph - 100)/2 ) + 'px'; 
    } 

    putInCenter("#mbolModal");

}