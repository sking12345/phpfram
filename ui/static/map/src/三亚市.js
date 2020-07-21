(function(root, factory) { if (typeof define === 'function' && define.amd) { define(['exports', 'echarts'], factory); } else if (typeof exports === 'object' && typeof exports.nodeName !== 'string') { factory(exports, require('echarts')); } else { factory({}, root.echarts); } }(this, function(exports, echarts) {
    var log = function(msg) { if (typeof console !== 'undefined') { console && console.error && console.error(msg); } };
    if (!echarts) { log('ECharts is not Loaded'); return; }
    if (!echarts.registerMap) { log('ECharts Map is not loaded'); return; }
    echarts.registerMap('三亚市', {
        "type": "FeatureCollection",
        "features": [{
            "type": "Feature",
            "id": "460203",
            "properties": { "name": "吉阳区", "cp": [109.578336, 18.281406], "childNum": 1 },
            "geometry": {
                "type": "Polygon",
                "coordinates": ["@@UBMDWP_`IDO@}CUDMDGHGNENCBRPZTB@JFNHFLDF@BDBJBH@@ABCBCB@BED@@@BBB@@B@B@BB@B@B@BB@BB@@@@@@BB@@@A@@@@BEA@@G@CDBF@@BDBB@J@DAF@@@L@@@D@FAF@@@@@@EFA@ABGDEHAHBDCFBBBEB@DAB@@@@B@@@@@@BB@@BB@BBBABBBBDB@BFB@@A@A@@B@B@B@@DAB@@@@AAABA@@B@B@@@@BD@FE@CBC@@B@BA@@BAAA@E@@@@@@@A@@A@@A@@@@A@@@@C@E@C@ABBBADAD@DB@BBDBBBBBB@B@D@@@B@@@@@@@BA@@B@@@@BA@@B@@ABDB@@BBA@FF@@CDAACB@B@@BB@@@B@BB@@A@BBBABBBB@AB@@A@BB@@A@@@@@@@@@@@A@@AA@A@@@@B@@@@@@@B@@@@@B@@@B@@BA@@BA@B@B@B@@@BA@@BCA@B@@E@@@ABA@AB@DBB@BBB@D@@BDCFADABA@@AAAAA@@@AAC@AAAA@A@AB@CA@@@BC@A@ABA@A@C@@AA@@@A@A@ACB@@@@C@@@@B@@@AA@I@@B@@@B@B@@@BA@C@@AB@A@BC@B@ABA@@@@A@@C@A@AA@@E@A@C@@A@A@@B@@A@@@@@A@@B@BB@B@B@@FA@@@@@ADA@@@@B@@@B@@@@@B@@@B@@AA@BA@@BC@@@@B@@@@@B@@A@@@@B@@A@@@A@A@A@ABA@@@@B@@BBA@@@@B@@@B@@@@@@BB@@@@B@ABBBC@@@@@@@@B@@AA@@@@@@@@@@@@@@@@@@@@A@@@@A@@@BABAHCDDDLFD@@B@F@BA@@BAB@BAD@D@DBDD@B@BBDBB@DBBABC@ABBHDD@@HBBB@JADAB@B@B@FA@A@@B@@BAFC@CDCBEHCFLABAFAJ@DB@DBBBBF@FCHEBBBD@BBBBDLCLA@ABC@EDFFBFBFBBB@BBB@BBB@DBBDBBFDD@A@ABADA@@D@B@DA@@BBD@DBBAB@B@B@BBB@B@BA@@BBB@B@B@@AB@F@@A@@@AFAB@JEBA@BBBBBBB@BB@BBB@B@BB@@B@DB@@B@@AB@DCDEBA@@D@@@BB@@B@@@@AB@@@@AB@BAD@B@BB@@BBDB@@F@B@B@@@B@BB@@@BB@BBB@@@B@@AB@B@DBDBBD@@BB@@B@@AB@D@B@@@@@BBFD@@@B@BB@BB@A@AB@BCBABABCFADADBB@B@B@DABAB@B@@@B@BBHAB@B@@@BC@CBCDCDABCCCCACAA@VACIKCMD@CAACAAAAAAAB@D@BC@AD@D@BC@A@CAACAAAAC@CBAA@AA@CBA@CACBAD@BCBA@CAA@AD@BABABA@CCACACCAAAADA@C@A@EBC@CBADC@CAACCACCCCCA@C@CC@ABCBE@C@CCE@A@ECAAEBC@ADAB@BC@@@CD@DAACCE@A@A@C@EDADCBADAFBF@FADABADAB@DBBBB@D@@ADB@BDABADAF@D@BA@CB@D@DBD@B@BCBCBADAD@D@D@DDFDF@HBF@DCDBBDDABADADBF@FBDAB@HAPAW¡QO]MeIgC_DUDO@QCMCGAOGSOOKYKWEWA"],
                "encodeOffsets": [
                    [112203, 18579]
                ]
            }
        }, {
            "type": "Feature",
            "id": "460205",
            "properties": { "name": "崖州区", "cp": [109.171841, 18.357291], "childNum": 1 },
            "geometry": {
                "type": "Polygon",
                "coordinates": ["@@M@©C_BUBKFEFELIjGXETEHGDSDQ@iBk@SBA@AQCKGEGGCIKAGBGDGHYlB@BBBBDDBBAF@DDBHFDBFBBDBBRD@B@@@D@F@BDF@BBDB@BB@BBB@BBBB@B@@BB@@BDDAB@@BBHBLA@BB@@BBB@BBBDBBDB@B@B@BBB@B@BBD@@@B@B@B@@@BABBB@BBFFHBD@FAD@BA@AB@@@B@@BBB@BBDHPBB@DBBBBB@B@DCBAB@DADADADAHDDDFDDBDBBDDBHBBD@@@@@@@@@@@B@@@@@@@@@@BFJAHC@ABCBB@@@@@@@@@@B@@@@@@@@@@BBABD@BNDB@@@@@@@@@@@@@@@@@@@B@@@@@@@@@@@@@@@@@JCHA@BBBF@DDF@@@B@@@@B@@@@B@@@@@@@@@@@B@@@@@@@@@@@@B@@@@@@@@@@@@@@@@B@@@@@@@@@@@@A@@@@@@@@@@B@@@@@@@@@@@@@@@@@@@@@@@BA@@@@@@@@@@@@@@@A@@@@@@@@@@@@@@B@@@@A@@@@@@@@@@@@@@@@@@@@@@B@@@@@@@@@@@BA@@@@@@@@@@@@@@B@@@B@@@@@@@@@B@FCFKDCJAJAFBFDHFLGXI|@B@RQAEACCCACCEACDBDFfIB@FIBEF@F@B@BCBEB@BAAA@EAACBCAAAAACB@C@@@A@A@ABA@AAC@@@A@C@A@@BA@C@C@AB@@A@A@A@@@A@ABAAA@@@A@@@A@A@A@A@@@A@A@@BC@AA@AA@@@A@A@C@C@A@A@AA@@A@A@@C@C@EBCAAAACACCCCAA@E@E@ABC@CCCAA@EA@C@CBCBEACAC@EAE@CDE@CAECIACBABA@EACBCBE@@@A@ABE@E@E@E@E@E@C@G@G@IBE"],
                "encodeOffsets": [
                    [111855, 18701]
                ]
            }
        }, {
            "type": "Feature",
            "id": "460204",
            "properties": { "name": "天涯区", "cp": [109.452378, 18.298156], "childNum": 1 },
            "geometry": {
                "type": "Polygon",
                "coordinates": ["@@GHSH×VUJYVMNop]JUHmACAF@J@H@H@D@F@F@F@F@FAF@B@B@@AFADBD@FABABBDDJBF@DCF@DBF@FBDBDAFAD@D@DFBB@DBDDD@BAF@F@B@DBDDBDBDBBDBFAD@D@@@@B@BB@@B@B@B@D@D@B@B@@BBB@@BAD@@@B@B@@@B@B@B@B@@@B@@BBAB@B@B@@@B@B@BA@@B@D@DAB@@@B@D@B@@BD@BAB@B@B@B@@@DDABBBBDBDABB@FBBABA@AFADA@E@E@AFEJA@eJCECABDDFBDDDBDBFQRA@{@WJKHB@@BEFBDDBF@BF@BFFAHBH@NCPCD@@EBAF@JCJ@HBHBFDBDH@@@@@@@@@@@@@@@B@@@@@@@D@@@@@@@B@@@@@@@@@@@@@B@@@@@@@B@@@@@@@@@@@@@B@@@@@@@@@@@@@@@B@@@@@@@@@@@@@@@B@@@@@@B@@@@@@@@@@@@B@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@BB@@@@@@@@@@@@@@@@B@@@@@@@@@@@@@@@@@B@@@@@@@@@@@@@B@@@@@@@@@@@@@@@@@@@@@@@BFBBHD@FAHBHDFFDFBF@FCHANANA@@@@@@@@BB@@@@@@@@@@@@@@B@@@BB@@@@@@B@@@@@@BB@@@@@@@@@B@@@@@@@@@@@B@@@@@@@@@@@@B@@@@B@@@@@@@@@@@@@@@@@B@@@@@@@@@@@@@@BB@@@@@@@@@@@@@@@@@BB@@@@@@@@@@@@@@B@@@@B@@@@@@@@@@@@B@@@@@@@@@@@@@BB@@@@@@@@@@@@@@@@@@@@@@B@@@@@@@@@@@@@@@B@@@@@@@@@@@@@@@@@B@@@@@@@@A@@@@@@@@B@@@@@@@@@@@@A@@B@@@@@@A@@B@@@@@@@@@@@@A@@@@B@@@@@@@@@B@@@@@@@@@@@@@@@@@@@@AB@@@@@@@@@@@@@@@@@@@@@@@@@@@B@@@@@@@@@@@@@@@B@@A@@@@@@@@@@@@B@@@@@@@@@@@@@@@@@B@@A@@@@@@@@@@@@B@@@@@@B@@@@@@LGDAFEDE@A@@@A@@@@@@@@@@@@@@@@@@@@@@@@B@@@@A@@@@@@@@@@@@@@B@@@@A@@@@@@@AB@@A@@@@BC@@B@@A@@@@BA@@@@@@@A@@@@B@@@@@D@D@DBFAFCB@@@@@@A@@@@@@@@@@@@@@@@@A@@@@@@@@@@@A@@@@@@@@@@@@@@@@@AA@@@@@@A@@@@@@BMDIB@B@@@@@@@@@@@@@@@BB@@@@FFDBDBDCDA@@JBDDBBDDBFBD@@@@@@@B@@@@@@@@@B@@@@@@@@@B@@@@@@@@@@@@@BCJ@@CFCFAF@@@@@B@@@@@B@@@@@B@@B@@@@@@@@@@@@@@B@@@@@@@@@@@@@@@@@@@@@@@B@@@@@@@@@@@@@@@@@@@@@@B@@@@@@B@@@@@@@@@@@B@@@@@@@@@@@@@@@@B@@B@@@@@@BB@@@@@@BB@@@@@BB@@@@@@@@@@BB@@@BB@@@@B@@BBB@@DB@BBB@@@@@@@@@@B@@B@@@@BB@@@@BB@@@@@@@@@@@B@@@@@@@@@@@@@@@@@@B@@@@@@B@@@@@@@@@@@@@@@@@B@@@@@@@@@@@@@@@@@@@@@@@@@B@@@@@@@@@@@@@@@@@@@B@@@@@@@@@@@@@B@@@@@@@@@@@@@B@@@@@@B@@@@B@@@@@@@@@@@@@@@@@@@BB@@@@@@@@@@@@B@@@@@@B@@@@@@@@@@B@@@@@@B@@@@@@@@@@@BB@@@@@@@@@@@@B@@@@@@@@@@@B@@@@@@@@BB@@@@@B@BB@@@@@@B@@@@@B@@B@@@@@@@@B@@@@@@@B@@@@@@@B@@@@@@@@@@@@@@@B@@@@BB@@@@@B@@@@@@@@@@@@@B@@B@@@@@@@@@@@@B@@@@@@@@@@B@@BBB@@@@B@@@@@@@@@@B@@@@@@@@B@@@@@@@@@@B@@@@@@@@B@@@@@@B@@@@@@@@@@@@@@B@@@@B@@@@@@@@@@@@@@@@@@@@@@A@@B@@@@@B@@@@@@@@@@@B@@@@@@@@@@@@@@@B@@@@@@@@@@@@@@@BB@@@@@@@@@@@@@@@@BB@@BB@@@@@@@@B@@B@@@@@@@@@@B@@@@B@@@@@@@@@@@@B@@@@@@@@BB@@@@@@@@@@@@@B@@B@@@@@@@@@@@@@@B@@@@@@@B@@@@@@@B@@@@@@@@@@@@@@@B@@B@@@@@@@@@@@@@@@@@@B@@B@@@@@@BB@@@@@B@@B@@@@@@@@B@@B@@@@@@BB@@@@@@BB@@@@@@@BB@@@@@@@@@@B@@B@@@@B@@@@@@@BB@@@@@@B@@@@B@@@@B@@@@@@@@@@BB@@@@@@@@@@@@@@@BB@@@@@@@@BB@@@@@@@B@@B@@@@@@B@@@@@@BB@@@@@@@@@@@@@B@@@@B@@@@@@@@B@@@@@B@@@@BB@@@B@@@@@B@@B@@@@@@B@@@@@@@B@@B@@@@@@B@@@@@@B@@@@B@@@@@@@@B@@B@@@@@@B@@@@B@@B@@@@@@@@BB@@@@@@@B@@@@@@@@B@@@@@@B@@@@@@@@@@@@@@@@@@@B@@@@@@@@@@@@@@@@@@@@@@AB@@@@@@@@@@@@@@@@@@@B@@@@@@@@@@@B@@@@@@@@@@@@@B@@@@@@@@@@@@@@@B@@@@@@@@@@@B@@@@@@@@@@B@@@@@@@@@@@@@CFC@ABA@O@AAC@A@@AC@ADABAACD@B@BC@C@A@ABCBA@CBADCBA@CBA@AAEBABCB@BABB@A@C@AAA@@CA@CBC@@BABAB@D@FDBB@B@BBBBAB@BBB@D@BAFAFEFCFAB@BADADCN@D@DBPDJED@BADAHCJBBAB@B@D@B@F@DD@AB@DE@ABQDAFAJAB@NABAFAHCDCB@BEAC@OAA@ABG@A@EBA@A@OAAAAB@@CBE@A@A@AAAAAIGAACEAABCBEAACA@AAM@A@A@@CAAA@I@AJGBA@G@AAEA@@A@A@A@AAAGGA@ABA@AB@@AB@@A@@@@ABA@A@G@@BAB@B@@ABCFC@ALCB@BA@@@@@A@@BAB@@@BI@AJCBA@@@A@A@@@A@@@A@GBCCCAECAAA@CAA@AAA@AAAEAEAEACE@FAD@BKBKDACAA@AACAAGFEDE@AAAA@CCAI@EBABKBDEFGDADCD@BE@AA@@@@BEBA@A@A@CBIBA@AA@GC@GCAA@BADABCAA@CAAAA@C@AC@C@CBC@ABA@AB@@A@E@AC@KECCDCBGBA@A@@@B@@B@@@@@@@@@@@@@@@@@@@@@BB@@@A@@@@@@D@AABAA@@@@@AA@@@@@@@A@@@A@@B@AA@@@A@@B@BAB@B@B@@@B@@@@A@@B@@@@A@@@@@A@@D@@AB@@ABB@@@A@@@A@@@@@A@@@A@@B@BC@@@@B@@EA@A@A@@A@AB@@@@@B@@@@AB@B@@@@D@B@FB@@B@B@DB@@@@@AB@B@AADB@A@@BD@B@@A@@@A@A@@@AJ@B@@B@@@A@@D@@@@@DA@B@B@B@@BB@@@D@BAB@B@BAD@@B@@DBAB@B@BB@BBD@B@@BBBB@BB@BABCDEAC@@@CAA@AAA@CBAB@BA@@F@@@@ADB@AB@@A@@@A@A@AAB@@AB@@@A@@@A@@@@@A@@@@@@@A@@B@B@@BB@@@@@@@@@@@B@@@AAB@@@BAA@AABAAA@A@BA@@A@A@@AA@@@ADABBDC@@EEB@AA@@CABA@@@AB@@A@@A@@@AB@@@@@@A@@@C@A@A@AAAACAAAA@@CBCBCAABAD@F@D@@@@@@B@@B@@@@BB@@@@@@@F@B@BB@AB@@A@AD@DAF@@EAC@@@@@A@AB@BABB@@@@BA@CA@A@A@@@@B@BA@AEA@ACAABAAA@AAA@@AA@@@@@@@A@@A@CBA@AFAADEACBGFGHCBAB@FE@@@@@@BE@E@C@@@K@@BE@C@IAAAC@@AEDCH@@@FB@A@@B@@@A@@A@@@@A@@AAAA@A@A@@A@A@AA@AA@@C@AFA@ADAD@BG@IACA@ACEEKMGIEA@YSQO"],
                "encodeOffsets": [
                    [112082, 18629]
                ]
            }
        }, {
            "type": "Feature",
            "id": "460202",
            "properties": { "name": "海棠区", "cp": [109.752569, 18.400106], "childNum": 1 },
            "geometry": {
                "type": "Polygon",
                "coordinates": ["@@FBFD@DABABCF@DBBB@BBBB@B@B@B@BH@B@D@@@@LAD@B@JFHFHDDB@FEDC@@FADCDE@@BB@HAJABAF@P@BDL@BBD@HFJDFDDDD@@@@BBB@B@D@BAB@@@@@BB@BABABAD@B@@@B@DBBBBAB@BAB@@@@@BBF@@@B@@@@@B@@B@H@B@D@NHFD@BBBBABA@@FBHDHBD@BBDRBD@L@@@D@B@B@BBB@AD@B@DBDD@ABADABAD@@@BABABEB@@A@KBA@@@@@@AAAAA@@CACACAE@ABABEBEDCBADAJEH@J@D@BCFGDEFCBCBEDI@EAEAA@@CC@A@@AA@CAA@A@@@@@@@A@E@GACACAAA@ICI@A@GAA@AC@E@E@ABCBC@ADC@CBEBI@EBAAAKCFGFBB@DMXUEQICCEOAEAQC[IYMaC]CgOBGBA@CBEAE@CACBABCBACCACDE@GAE@ECCCC@C@C@CBABADADA@C@CAC@A@@DABC@E@CBABCB@ACA@BC@A@AACAA@CBABCBEBE@EACBABCDCB@F@D@B@BDFBDCBC@@D@@ADA@CB@BADBFDB@F@BDF@D@DAFAD@BDDD@B@DDDDBDDDBB@DCDAB@DAD@F@B@DCBBBBBDDDBDB@DABABABC@@BBB@DABADC@ABBD@DAB@DBBB@AB@DBDBBDBBB@D@BADC@C@@BADC@A@BBBBBBDBBB@DNCLDDJUBB@DBDBDDADCBCDAD@DAD@B@B@BBD@@B@BBFBB@B@@@@ADC@@DA"],
                "encodeOffsets": [
                    [112310, 18836]
                ]
            }
        }],
        "UTF8Encoding": true
    });
}));