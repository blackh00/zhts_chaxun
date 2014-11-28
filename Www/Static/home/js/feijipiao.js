// 保存城市及对应编号
var cA = [];
cA['北京'] = 'beijing';
cA['上海'] = 'SHA';
cA['广州'] = 'CAN';
cA['深圳'] = 'SZX';
cA['成都'] = 'CTU';
cA['杭州'] = 'HGH';
cA['武汉'] = 'WUH';
cA['西安'] = 'SIA';
cA['重庆'] = 'CKG';
cA['青岛'] = 'TAO';
cA['长沙'] = 'CSX';
cA['南京'] = 'NKG';
cA['厦门'] = 'XMN';
cA['昆明'] = 'KMG';
cA['大连'] = 'DLC';
cA['天津'] = 'TSN';
cA['郑州'] = 'CGO';
cA['三亚'] = 'SYX';
cA['济南'] = 'TNA';
cA['福州'] = 'FOC';
cA['阿勒泰'] = 'AAT';
cA['百色'] = 'AEB';
cA['安康'] = 'AKA';
cA['阿克苏'] = 'AKU';
cA['鞍山'] = 'AOG';
cA['安庆'] = 'AQG';
cA['安顺'] = 'AVA';
cA['包头'] = 'BAV';
cA['北海'] = 'BHY';
cA['博乐'] = 'BPL';
cA['昌都'] = 'BPX';
cA['保山'] = 'BSD';
cA['常德'] = 'CGD';
cA['长春'] = 'CGQ';
cA['朝阳'] = 'CHG';
cA['赤峰'] = 'CIF';
cA['长治'] = 'CIH';
cA['重庆'] = 'CKG';
cA['长沙'] = 'CSX';
cA['成都'] = 'CTU';
cA['常州'] = 'CZX';
cA['大同'] = 'DAT';
cA['达县'] = 'DAX';
cA['丹东'] = 'DDG';
cA['迪庆'] = 'DIG';
cA['大连'] = 'DLC';
cA['大理市'] = 'DLU';
cA['敦煌'] = 'DNH';
cA['东营'] = 'DOY';
cA['大庆'] = 'DQA';
cA['鄂尔多斯'] = 'DSN';
cA['恩施'] = 'ENH';
cA['二连浩特'] = 'ERL';
cA['福州'] = 'FOC';
cA['阜阳'] = 'FUG';
cA['佛山'] = 'FUO';
cA['德宏'] = 'LUM';
cA['北京'] = 'beijing';
cA['长白山'] = 'NBS';
cA['阿里'] = 'NGQ';
cA['巴彦淖尔'] = 'RLK';
cA['阿尔山'] = 'YIE';
cA['广州'] = 'CAN';
cA['广汉'] = 'GHN';
cA['格尔木'] = 'GOQ';
cA['广元'] = 'GYS';
cA['固原'] = 'GYU';
cA['海口'] = 'HAK';
cA['邯郸'] = 'HDG';
cA['黑河'] = 'HEK';
cA['呼和浩特'] = 'HET';
cA['合肥'] = 'HFE';
cA['杭州'] = 'HGH';
cA['淮安'] = 'HIA';
cA['怀化'] = 'HJJ';
cA['海拉尔'] = 'HLD';
cA['哈密市'] = 'HMI';
cA['哈尔滨'] = 'HRB';
cA['和田市'] = 'HTN';
cA['汉中'] = 'HZG';
cA['景德镇'] = 'JDZ';
cA['加格达奇'] = 'JGD';
cA['嘉峪关'] = 'JGN';
cA['井冈山'] = 'JGS';
cA['金昌'] = 'JIC';
cA['吉林'] = 'JIL';
cA['九江'] = 'JIU';
cA['晋江'] = 'JJN';
cA['佳木斯'] = 'JMU';
cA['济宁'] = 'JNG';
cA['锦州'] = 'JNZ';
cA['鸡西'] = 'JXA';
cA['九寨沟'] = 'JZH';
cA['赣州'] = 'KOW';
cA['贵阳'] = 'KWE';
cA['桂林'] = 'KWL';
cA['光化'] = 'LHK';
cA['揭阳'] = 'SWA';
cA['济南'] = 'TNA';
cA['黄山'] = 'TXN';
cA['黎平'] = 'HZH';
cA['库车'] = 'KCA';
cA['康定'] = 'KGT';
cA['喀什市'] = 'KHG';
cA['南昌'] = 'KHN';
cA['昆明'] = 'KMG';
cA['库尔勒'] = 'KRL';
cA['克拉玛依'] = 'KRY';
cA['龙岩'] = 'LCX';
cA['兰州'] = 'LHW';
cA['梁平'] = 'LIA';
cA['丽江'] = 'LJG';
cA['临沧'] = 'LNJ';
cA['拉萨'] = 'LXA';
cA['林西'] = 'LXI';
cA['洛阳'] = 'LYA';
cA['连云港'] = 'LYG';
cA['临沂'] = 'LYI';
cA['柳州'] = 'LZH';
cA['泸州'] = 'LZO';
cA['林芝'] = 'LZY';
cA['牡丹江'] = 'MDG';
cA['绵阳'] = 'MIG';
cA['梅州'] = 'MXZ';
cA['马公'] = 'MZG';
cA['南充'] = 'NAO';
cA['宁波'] = 'NGB';
cA['南京'] = 'NKG';
cA['那拉提'] = 'NLT';
cA['南宁'] = 'NNG';
cA['南阳'] = 'NNY';
cA['南通'] = 'NTG';
cA['满洲里'] = 'NZH';
cA['漠河'] = 'OHE';
cA['乌兰浩特'] = 'HLH';
cA['台州'] = 'HYN';
cA['且末'] = 'IQM';
cA['庆阳'] = 'IQN';
cA['黔江'] = 'JIQ';
cA['衢州'] = 'JUZ';
cA['齐齐哈尔'] = 'NDG';
cA['上海'] = 'SHA';
cA['攀枝花'] = 'PZI';
cA['日喀则'] = 'RKZ';
cA['沈阳'] = 'SHE';
cA['秦皇岛'] = 'SHP';
cA['沙市'] = 'SHS';
cA['石家庄'] = 'SJW';
cA['普洱'] = 'SYM';
cA['三亚'] = 'SYX';
cA['深圳'] = 'SZX';
cA['青岛'] = 'TAO';
cA['塔城'] = 'TCG';
cA['铜仁市'] = 'TEN';
cA['通辽'] = 'TGO';
cA['天水'] = 'THQ';
cA['天津'] = 'TSN';
cA['唐山'] = 'TVS';
cA['桐乡'] = '580';
cA['太原'] = 'TYN';
cA['乌鲁木齐'] = 'URC';
cA['潍坊'] = 'WEF';
cA['威海'] = 'WEH';
cA['文山县'] = 'WNH';
cA['温州'] = 'WNZ';
cA['乌海'] = 'WUA';
cA['武汉'] = 'WUH';
cA['武夷山'] = 'WUS';
cA['无锡'] = 'WUX';
cA['梧州'] = 'WUZ';
cA['万州'] = 'WXN';
cA['兴义'] = 'ACX';
cA['郑州'] = 'CGO';
cA['张家界'] = 'DYG';
cA['延安'] = 'ENY';
cA['舟山'] = 'HSN';
cA['银川'] = 'INC';
cA['西双版纳'] = 'JHG';
cA['伊春'] = 'LDS';
cA['永州'] = 'LLF';
cA['榆林'] = 'UYN';
cA['襄阳'] = 'XFN';
cA['西昌'] = 'XIC';
cA['锡林浩特'] = 'XIL';
cA['西安'] = 'SIA';
cA['厦门'] = 'XMN';
cA['西宁'] = 'XNN';
cA['徐州'] = 'XUZ';
cA['宜宾'] = 'YBP';
cA['运城'] = 'YCU';
cA['宜昌'] = 'YIH';
cA['伊宁市'] = 'YIN';
cA['义乌'] = 'YIW';
cA['延吉'] = 'YNJ';
cA['烟台'] = 'YNT';
cA['盐城'] = 'YNZ';
cA['扬州'] = 'YTY';
cA['张掖'] = 'YZY';
cA['昭通'] = 'ZAT';
cA['中山'] = 'ZGN';
cA['湛江'] = 'ZHA';
cA['中卫'] = 'ZHY';
cA['珠海'] = 'ZUH';
cA['遵义'] = 'ZYI';
var ext_city_code_map = {"\u963f\u4f2f\u4e01":"ABZ","\u963f\u4f2f\u4e01\uff08\u7f8e\uff09":"ABR","\u963f\u6bd4\u6797":"ABI","\u963f\u5e03\u624e\u6bd4":"AUH","\u963f\u5e03\u8d3e":"ABV","\u963f\u5361\u666e\u5c14\u79d1":"ACA","\u963f\u514b\u62c9":"ACC","\u4e9a\u7684\u65af\u4e9a\u8d1d\u5df4":"ADD","\u963f\u5fb7\u83b1\u5fb7":"ADL","\u4e9a\u4e01":"ADE","\u827e\u54c8\u8fc8\u8fbe\u5df4\u5fb7":"AMD","\u963f\u96c5\u514b\u8096":"AJA","\u79cb\u7530":"AXT","\u963f\u514b\u4f26\/\u574e\u987f":"CAK","\u5965\u5c14\u5df4\u5c3c":"ALB","\u963f\u5c14\u5e03\u51ef\u514b":"ABQ","\u4e9a\u5386\u5c71\u5927":"ALY","\u8def\u6613\u65af\u5b89\u90a3\u5dde":"AEX","\u963f\u5c14\u76d6\u7f57":"AHO","\u963f\u5c14\u53ca\u5c14":"ALG","\u963f\u5229\u574e\u7279":"ALC","\u963f\u4f26\u6566":"ABE","\u963f\u62c9\u6728\u56fe":"ALA","\u4e9a\u7f57\u58eb\u6253":"AOR","\u963f\u5c14\u76ae\u7eb3":"APN","\u963f\u5c14\u5854":"ALF","\u963f\u9a6c\u91cc\u6d1b":"AMA","\u5b89\u66fc":"AMM","\u963f\u59c6\u5229\u5219":"ATQ","\u963f\u59c6\u65af\u7279\u4e39":"AMS","\u5b89\u79d1\u96f7\u5947":"ANC","\u5b89\u79d1\u7eb3":"AOI","\u963f\u5185\u897f":"NCY","\u5b89\u63d0\u74dc":"ANU","\u5b89\u7279\u536b\u666e":"ANR","\u9752\u68ee":"AOJ","\u963f\u666e\u5c14\u987f":"ATW","\u5317\u5361\u7f57\u6765\u7eb3\u5dde":"AVL","\u963f\u4ec0\u54c8\u5df4\u5fb7":"ASB","\u963f\u65af\u5f6d":"ASE","\u96c5\u5178":"ATH","\u4e9a\u7279\u5170\u5927":"ATL","\u5927\u897f\u6d0b\u57ce":"AIY","\u5965\u514b\u84dd":"AKL","\u5965\u53e4\u65af\u5854":"AGS","\u5965\u65af\u6c40":"AUS","\u963f\u7ef4\u5c3c\u7fc1":"AVN","\u5df4\u6797":"BAH","\u8d1d\u514b\u65af\u83f2\u5c14\u5fb7":"BFL","\u5df4\u5e93":"GYD","\u5df4\u5398\u5c9b":"DPS","\u8345\u91cc\u5df4\u73ed":"BPN","\u5df4\u5c14\u7684\u6469":"BWI","\u65af\u91cc\u5df4\u52a0\u6e7e\u5e02":"BWN","\u73ed\u52a0\u7f57\u5c14":"BLR","\u66fc\u8c37":"BKK","\u73ed\u6208":"BGR","\u5df4\u585e\u7f57\u90a3":"BCN","\u5df4\u91cc":"BRI","\u5df4\u585e\u5c14":"BSL","\u5df4\u65af\u8482\u4e9a":"BIA","\u5df4\u541e\u9c81\u65e5":"BTR","\u5fb7\u514b\u8428\u65af\u5dde":"BPT","\u8d1d\u9c81\u7279":"BEY","\u8d1d\u5c14\u683c\u83b1\u5fb7":"BEG","\u8d1d\u6797\u54c8\u59c6":"BLI","\u4f2f\u7c73\u5409":"BJI","\u5351\u5c14\u6839":"BGO","\u67cf\u6797":"TXL","\u767e\u6155\u5927":"BDA","\u4f2f\u5c14\u5c3c":"BRN","\u6bd4\u4e9a\u91cc\u8328":"BIQ","\u6bd5\u5c14\u5df4\u9102":"BIO","\u6bd4\u6797\u65af":"BIL","\u6bd4\u4f26\u5fb7":"BLL","\u5bbe\u6c49\u987f":"BGM","\u4f2f\u660e\u7ff0":"BHM","\u6bd4\u4ec0\u51ef\u514b":"FRU","\u4ffe\u65af\u9ea6":"BIS","\u5e03\u5362\u660e\u987f.\u8bfa\u6728\u5c14":"BMI","\u535a\u591a":"BOO","\u535a\u4f0a\u897f":"BOI","\u6ce2\u4f26\u4e9a":"BLQ","\u6ce2\u5c14\u591a":"BOD","\u6ce2\u58eb\u987f":"BOS","\u535a\u5179\u66fc":"BZN","\u5eb7\u6d85\u72c4\u683c\u5dde":"BDL","\u5e03\u96f7\u7eb3\u5fb7":"BRD","\u5df4\u897f\u5229\u4e9a":"BSB","\u5e03\u62c9\u8fea\u65af\u62c9\u53d1":"BTS","\u4e0d\u6765\u6885":"BRE","\u5e03\u96f7\u65af\u7279":"BES","\u5e03\u91cc\u5947\u6566":"BGI","\u5e03\u6797\u8fea\u897f":"BDS","\u5e03\u91cc\u65af\u73ed":"BNE","\u5e03\u91cc\u65af\u6258\u5c14":"BRS","\u5e03\u6717\u65af\u7ef4\u5c14":"BRO","\u5e03\u9c81\u585e\u5c14":"BRU","\u5e03\u52a0\u52d2\u65af\u7279":"BUH","\u5e03\u8fbe\u4f69\u65af":"BUD","\u5e03\u5b9c\u8bfa\u65af\u827e\u5229\u65af":"BUE","\u5e03\u6cd5\u7f57":"BUF","\u4f2f\u73ed\u514b":"BUR","\u4f2f\u6797\u987f":"BRL","\u6bd4\u5c24\u7279":"BTM","\u5361\u5229\u4e9a\u91cc":"CAG","\u51ef\u6069\u65af":"CNS","\u5f00\u7f57":"CAI","\u52a0\u5c14\u5404\u7b54":"CCU","\u5361\u5c14\u52a0\u91cc":"YYC","\u5361\u5229\u5361\u7279":"CCJ","\u52a0\u5229\u798f\u5c3c\u4e9a\u5dde":"XNA","\u5361\u5c14\u7ef4":"CLY","\u582a\u57f9\u62c9":"CBR","\u5f00\u666e\u5409\u62c9\u591a":"CGI","\u5f00\u666e\u987f":"CPT","\u52a0\u62c9\u52a0\u65af":"CCS","\u52a0\u7684\u592b":"CWL","\u5361\u8428\u5e03\u5170\u5361":"CAS","\u5361\u65af\u73c0":"CPR","\u5361\u5854\u5c3c\u4e9a":"CTA","\u5bbf\u52a1":"CEB","\u9521\u8fbe\u62c9\u76ae\u5179":"CID","\u67e5\u5c14\u65af\u987f":"CRW","\u590f\u6d1b\u7279":"CLT","\u67e5\u5854\u52aa\u52a0":"CHA","\u9a6c\u5fb7\u62c9\u65af":"MAA","\u6e0d\u8fc8":"CNX","\u9752\u83b1":"CEI","\u829d\u52a0\u54e5":"CHI","\u5409\u5927\u6e2f":"CGP","\u514b\u8d56\u65af\u7279\u5f7b\u5947":"CHC","\u8f9b\u8f9b\u90a3\u63d0":"CVG","\u514b\u62c9\u514b\u65af\u5821":"CKB","\u514b\u83b1\u8499\u8d39\u6717":"CFE","\u514b\u91cc\u592b\u5170":"CLE","\u514b\u5362\u65e5":"CLJ","\u79d1\u5229\u5947\u7ad9":"CLL","\u79d1\u9686":"CGN","\u79d1\u4f26\u5761":"CMB","\u79d1\u7f57\u62c9\u591a\u65af\u666e\u6797":"COS","\u54e5\u4f26\u6bd4\u4e9a":"CAE","\u54e5\u4f26\u5e03":"CMH","\u54e5\u672c\u54c8\u6839":"CPH","\u79d1\u514b":"ORK","\u79d1\u5b81":"ELM","\u79d1\u73c0\u65af\u79d1\u91cc\u65af\u8482":"CRP","\u79d1\u82cf\u6885\u5c14":"CZM","\u5927\u4e18":"TAE","\u8fbe\u5580\u5c14":"DKR","\u8fbe\u62c9\u65af\/\u6c83\u65af\u5821":"DFW","\u5927\u9a6c\u58eb\u9769":"DAM","\u8fbe\u66fc":"DMM","\u8fbe\u7d2f\u65af\u8428\u62c9\u59c6":"DAR","\u6234\u987f":"DAY","\u4ee3\u6258\u7eb3\u6bd4\u5947":"DAB","\u8fea\u51ef\u7279":"DEC","\u65b0\u5fb7\u91cc":"DEL","\u4e39\u4f5b":"DEN","\u5f97\u6885\u56e0":"DSM","\u5e95\u7279\u5f8b":"DTT","\u8fbe\u5361":"DAC","\u5e1d\u529b":"DIL","\u591a\u54c8":"DOH","\u591a\u7279\u8499\u7279":"DTM","\u8fea\u62dc":"DXB","\u90fd\u4f2f\u6797":"DUB","\u675c\u5e03\u7f57\u592b\u5c3c\u514b":"DBV","\u8fea\u6bd4\u514b":"DBQ","\u5fb7\u5362\u65af":"DLH","\u5fb7\u73ed":"DUR","\u675c\u5c1a\u522b":"DYU","\u675c\u585e\u5c14\u591a\u592b":"DUS","\u4f0a\u65af\u987f":"ABE","\u6b27\u514b\u83b1\u5c14":"EAU","\u7231\u4e01\u5821":"EDI","\u57c3\u5fb7\u8499\u987f":"YEG","\u57c3\u5c14\u5e15\u7d22":"ELP","\u6069\u5fb7\u57f9":"EBB","\u4f0a\u5229":"ERI","\u57c3\u65af\u5361\u7eb3\u5df4":"ESC","\u5c24\u91d1":"EUG","\u57c3\u6587\u65af\u7ef4\u5c14":"EVV","\u57c3\u6c83\u5185\u65af":"EVE","\u6cd5\u6208":"FAR","\u6cd5\u9c81":"FAO","\u8d39\u8036\u7279\u7ef4\u5c14":"FAY","\u5f17\u6797\u7279":"FNT","\u4f5b\u7f57\u4f26\u8428":"FLR","\u8fc8\u5c14\u65af\u5821":"RSW","\u53f2\u5bc6\u65af\u5821":"FSM","\u74e6\u5c14\u5e15\u83b1\u7d22":"VPS","\u97e6\u6069\u5821":"FWA","\u6cd5\u5170\u514b\u798f":"FRA","\u5f17\u96f7\u65af\u8bfa":"FAT","\u52b3\u5fb7\u5c14\u5821":"FLL","\u798f\u5188":"FUK","\u4e30\u6c99\u5c14":"FNC","\u683c\u4f46\u65af\u514b":"GDN","\u65e5\u5185\u74e6":"GVA","\u70ed\u90a3\u4e9a":"GOA","\u683c\u62c9\u65af\u54e5":"GLA","\u679c\u963f":"GOI","\u6208\u5c14\u5fb7\u79d1\u65af\u7279":"OOL","\u54e5\u5fb7\u5821":"GOT","\u5927\u52a0\u90a3\u5229\u5c9b":"LPA","\u5927\u5f00\u66fc\u5c9b":"GCM","\u5927\u798f\u514b\u65af":"GFK","\u5927\u6025\u6d41":"GRR","\u683c\u62c9\u8328":"GRZ","\u683c\u96f7\u7279\u7206\u5e03":"GTF","\u683c\u6797\u8d1d":"GRB","\u683c\u6797\u65af\u4f2f\u52d2":"GSO","\u683c\u6797\u7ef4\u5c14":"GSP","\u683c\u6797\u7eb3\u8fbe":"GND","\u74dc\u8fbe\u62c9\u54c8\u62c9":"GDL","\u5173\u5c9b":"GUM","\u683c\u5c14\u592b\u6ce2\u7279":"GPT","\u51fd\u9986":"HKD","\u54c8\u5229\u6cd5\u514b\u65af":"YHZ","\u6c49\u5821":"HAM","\u6c49\u8003\u514b\/\u970d\u6566":"CMX","\u6cb3\u5185":"HAN","\u6c49\u8bfa\u5a01":"HAJ","\u54c8\u62c9\u96f7":"HRE","\u54c8\u7075\u6839":"HRL","\u54c8\u5229\u65af\u5821":"MDT","\u5408\u827e":"HDY","\u6d77\u4e8e\u683c\u751f\u5fb7":"HAU","\u54c8\u74e6\u90a3":"HAV","\u590f\u5a01\u5937":"HNL","\u8d6b\u52d2\u7eb3":"HLN","\u8d6b\u5c14\u8f9b\u57fa":"HEL","\u4f0a\u62c9\u514b\u5229\u7fc1":"HER","\u897f\u5bbe":"HIB","\u5e7f\u5c9b":"HIJ","\u80e1\u5fd7\u660e\u5e02":"SGN","\u970d\u5df4\u7279":"HBA","\u9999\u6e2f":"HKG","\u4f11\u65af\u6566":"HOU","\u4ea8\u4f2f\u8d5b\u5fb7":"HUY","\u4ea8\u5ef7\u987f":"HTS","\u4ea8\u8328\u7ef4\u5c14":"HSV","\u6d77\u6069\u5c3c\u65af":"HYA","\u6d77\u5f97\u62c9\u5df4":"HYD","\u4f0a\u6bd4\u8428":"IBZ","\u7231\u8fbe\u8377\u798f\u5c14\u65af":"IDA","\u5370\u7b2c\u5b89\u90a3\u6ce2\u5229\u65af":"IND","\u56e0\u65af\u5e03\u9c81\u514b":"INN","\u56e0\u5f17\u5185\u65af":"INV","\u6021\u4fdd":"IPH","\u4f0a\u5c14\u5e93\u8328\u514b":"IKT","\u4f0a\u65af\u5170\u5821":"ISB","\u4f0a\u65af\u5766\u5e03\u5c14":"IST","\u6770\u514b\u900a":"JAN","\u6770\u514b\u900a\u7ef4\u5c14":"JAX","\u96c5\u52a0\u8fbe":"JKT","\u5409\u8fbe":"JED","\u6d4e\u5dde":"CJU","\u8d6b\u96f7\u65af-\u5fb7\u62c9\u5f17\u9f99\u7279\u62c9":"XRY","\u6cfd\u897f":"JER","\u7ea6\u7ff0\u5185\u65af\u5821":"JNB","\u67d4\u4f5b\u5df4\u9c81":"JHB","\u8363\u5f7b\u5e73":"JKG","\u5580\u5e03\u5c14":"KBL","\u9e7f\u5c14\u5c9b":"KOJ","\u5361\u62c9\u9a6c\u7956":"AZO","\u5361\u5c14\u9a6c":"KLR","\u5361\u5229\u65af\u4f69\u5c14":"FCA","\u582a\u8428\u65af\u57ce":"MCI","\u9ad8\u96c4":"KHH","\u5361\u62c9\u5947":"KHI","\u52a0\u5fb7\u6ee1\u90fd":"KTM","\u5361\u6258\u7ef4\u5179":"KTW","\u51ef\u6d1b\u6c83\u7eb3":"YLW","\u57fa\u97e6\u65af\u5fb7":"EYW","\u5580\u571f\u7a46":"KRT","\u57fa\u5c14":"KEL","\u57fa\u8f85":"IEV","\u91d1\u65af\u6566":"KIN","\u57fa\u5f8b\u7eb3":"KRN","\u57fa\u82cf\u6728":"KIS","\u5317\u4e5d\u5dde":"KKJ","\u514b\u62c9\u6839\u798f":"KLU","\u514b\u62c9\u9a6c\u65af\u798f\u5c14\u65af":"LMT","\u8bfa\u514b\u65af\u7ef4\u5c14":"TYS","\u79d1\u94a6":"COK","\u82cf\u6885\u5c9b":"USM","\u5c0f\u677e":"KMQ","\u54e5\u6253\u57fa\u7eb3\u5df4\u5362":"BKI","\u514b\u62c9\u79d1\u592b":"KRK","\u514b\u91cc\u65af\u8482\u5b89\u6851":"KRS","\u5409\u9686\u5761":"KUL","\u74dc\u62c9\u4e01\u52a0\u5974":"TGG","\u53e4\u664b":"KCH","\u79d1\u5a01\u7279":"KWI","\u62c9\u79d1\u9c81\u5c3c\u4e9a":"LCG","\u62c9\u514b\u9c81\u4e1d":"LSE","\u62c9\u6590\u7279":"LFT","\u62c9\u5404\u65af":"LOS","\u62c9\u5408\u5c14":"LHE","\u83b1\u514b\u67e5\u5c14\u65af":"LCH","\u62c9\u7a46":"LAU","\u51cc\u5bb6\u536b\uff08\u5c9b\uff09":"LGK","\u62c9\u5c3c\u6c38":"LAI","\u5170\u8f9b":"LAN","\u5170\u8428\u7f57\u7279":"ACE","\u62c9\u96f7\u591a":"LRD","\u62c9\u7eb3\u5361":"LCA","\u62c9\u65af\u7ef4\u52a0\u65af":"LAS","\u83b1\u5df4\u5ae9":"LEB","\u5229\u5179":"LBA","\u6765\u6bd4\u9521":"LEJ","\u83b1\u6602-\u74dc\u7eb3\u534e\u6258":"BJX","\u5218\u6613\u65af\u987f":"LWS","\u5217\u514b\u661f\u6566":"LEX","\u5229\u6717\u683c\u97e6":"LLW","\u5229\u9a6c":"LIM","\u5229\u6469\u65e5":"LIG","\u6797\u80af":"LNK","\u6797\u5f7b\u5e73":"LPI","\u6797\u8328":"LNZ","\u91cc\u65af\u672c":"LIS","\u5c0f\u77f3\u57ce":"LIT","\u5229\u7269\u6d66":"LPL","\u5362\u5e03\u5c14\u96c5\u90a3":"LJU","\u4f26\u6566\uff08\u82f1\u56fd\uff09":"LON","\u4f26\u6566\uff08\u52a0\u62ff\u5927\uff09":"YXU","\u957f\u6ee9":"LGB","\u6717\u7ef4\u5c24":"GGG","\u6d1b\u91cc\u6602":"LRT","\u6d1b\u6749\u77f6":"LAX","\u8def\u6613\u65af\u7ef4\u5c14":"SDF","\u7f57\u5b89\u8fbe":"LAD","\u62c9\u4f2f\u514b":"LBB","\u5362\u672c\u5df4\u5e0c":"FBM","\u5415\u52d2\u5965":"LLA","\u5362\u8428\u5361":"LUN","\u5362\u68ee\u5821":"LUX","\u5362\u514b\u7d22":"LXR","\u91cc\u6602":"LYS","\u9a6c\u65af\u7279\u91cc\u8d6b\u7279":"MST","\u6fb3\u95e8":"MFM","\u9ea6\u8fea\u900a":"MSN","\u9a6c\u5fb7\u91cc":"MAD","\u9a6c\u57c3\u5c9b":"SEZ","\u9a6c\u62c9\u52a0":"AGP","\u9a6c\u7d2f":"MLE","\u9a6c\u8033\u4ed6":"MLA","\u4e07\u9e26\u8001":"MDC","\u66fc\u5f7b\u65af\u7279":"MAN","\u66fc\u5f7b\u65af\u7279\uff08\u7f8e\uff09":"MHT","\u66fc\u5fb7\u52d2":"MDL","\u9a6c\u5c3c\u62c9":"MNL","\u9a6c\u51ef\u7279":"MQT","\u9a6c\u62c9\u5580\u4ec0":"RAK","\u9a6c\u8d5b":"MRS","\u9a6c\u4ec0\u54c8\u5fb7":"MHD","\u6885\u68ee\u57ce":"MCW","\u9a6c\u5854\u5170":"AMI","\u677e\u5c71":"MYJ","\u9a6c\u8428\u7279\u5170":"MZT","\u9ea6\u5361\u4f26":"MFE","\u68c9\u5170":"MES","\u6885\u5fb7\u798f":"MFR","\u58a8\u5c14\u672c":"MEL","\u58a8\u513f\u672c":"MLB","\u5b5f\u83f2\u65af":"MEM","\u9ed8\u91cc\u8fea\u6069":"MEI","\u58a8\u897f\u54e5\u57ce":"MEX","\u8fc8\u963f\u5bc6":"MIA","\u7c73\u5fb7\u5170":"MAF","\u7c73\u5170":"MIL","\u5bc6\u5c14\u6c83\u57fa":"MKE","\u660e\u5c3c\u963f\u6ce2\u5229\u65af":"MSP","\u8fc8\u8bfa\u7279":"MOT","\u7f8e\u91cc":"MYY","\u7c73\u82cf\u62c9":"MSO","\u83ab\u6bd4\u5c14":"MOB","\u83ab\u6797":"MLI","\u8499\u514b\u987f":"YQM","\u95e8\u7f57":"MLU","\u8499\u7279\u96f7":"MRY","\u8499\u54e5\u9a6c\u5229":"MGM","\u8499\u5f7c\u5229\u57c3":"MPL","\u8499\u7279\u5229\u5c14":"YMQ","\u83ab\u65af\u79d1":"MOW","\u6469\u585e\u65af\u83b1\u514b":"MWH","\u8499\u65af\u7279":"FMO","\u7c73\u5362\u65af":"MLH","\u5b5f\u4e70":"BOM","\u6155\u5c3c\u9ed1":"MUC","\u9a6c\u65af\u5580\u7279":"MCT","\u9a6c\u65af\u57fa\u6839":"MKG","\u9ed8\u7279\u5c14\u6bd4\u5947":"MYR","\u7eb3\u8fea":"NAN","\u957f\u5d0e":"NGS","\u540d\u53e4\u5c4b":"NGO","\u5185\u7f57\u6bd5":"NBO","\u7eb3\u5948\u83ab":"YCD","\u5357\u7279":"NTE","\u90a3\u4e0d\u52d2\u65af":"NAP","\u8bfa\u4ec0\u7ef4\u5c14":"BNA","\u62ff\u9a9a":"NAS","\u65b0\u5965\u5c14\u826f":"MSY","\u7ebd\u7ea6":"NYC","\u7ebd\u74e6\u514b":"EWR","\u7ebd\u5821":"SWF","\u7ebd\u5361\u65af\u5c14":"NCL","\u5c3c\u65af":"NCE","\u65b0\u6cfb":"KIJ","\u8bfa\u798f\u514b":"ORF","\u8bfa\u5c14\u96ea\u5e73":"NRK","\u8bfa\u5a01\u5947":"NWI","\u65b0\u897f\u4f2f\u5229\u4e9a":"OVB","\u7ebd\u4f26\u5821":"NUE","\u5965\u514b\u5170":"OAK","\u5927\u5206":"OIT","\u5188\u5c71":"OKJ","\u51b2\u7ef3":"OKA","\u4fc4\u514b\u62c9\u4f55\u9a6c\u57ce":"OKC","\u5965\u9a6c\u54c8":"OMA","\u5b89\u5927\u7565":"ONT","\u5965\u5170\u591a":"MCO","\u5927\u962a":"OSA","\u5965\u65af\u9646":"OSL","\u5384\u65af\u7279\u677e\u5fb7":"OSD","\u6e25\u592a\u534e":"YOW","\u5965\u5362":"OUL","\u5e15\u5fb7\u535a\u6069":"PAD","\u5e15\u8fea\u5c24\u5361":"PAH","\u5de8\u6e2f":"PLM","\u5df4\u52d2\u83ab":"PMO","\u68d5\u6988\u6cc9":"PSP","\u5df4\u62ff\u9a6c\u57ce":"PTY","\u5df4\u62ff\u5df4\u57ce":"PFN","\u5e15\u62c9\u9a6c\u91cc\u535a":"PBM","\u5df4\u9ece":"CDG","\u6ce2\u57ce":"PUF","\u69df\u6994\u5c7f":"PEN","\u5f6d\u8428\u79d1\u62c9":"PNS","\u76ae\u5965\u91cc\u4e9a":"PIA","\u4f69\u76ae\u5c3c\u6602":"PGF","\u73c0\u65af":"PER","\u6c99\u74e6":"PEW","\u91d1\u8fb9":"PNH","\u83f2\u5c3c\u514b\u65af":"PHX","\u666e\u5409":"HKT","\u76ae\u5c14":"PIR","\u6bd4\u8428":"PSA","\u5339\u5179\u5821":"PIT","\u6ce2\u5361\u7279\u6d1b":"PIH","\u6ce2\u7279\u5170":"PDX","\u6ce2\u7279\u5170\uff08pwm\uff09":"PWM","\u6ce2\u5c14\u56fe":"OPO","\u6ce2\u5179\u5357":"POZ","\u5e03\u62c9\u683c":"PRG","\u4e54\u6cbb\u738b\u5b50\u57ce":"YXS","\u666e\u7f57\u7ef4\u767b\u65af":"PVD","\u4f0a\u4e3d\u838e\u767d\u6e2f":"PLZ","\u7f57\u8428\u91cc\u5965\u6e2f":"FUE","\u5df4\u4e9a\u5c14\u5854\u6e2f":"PVR","\u91dc\u5c71":"PUS","\u5e73\u58e4":"FNJ","\u9b41\u5317\u514b":"YQB","\u6606\u65af\u6566":"ZQN","\u574e\u4f69\u5c14":"UIP","\u7f57\u5229":"RDU","\u4ef0\u5149":"RGN","\u62c9\u76ae\u5fb7\u57ce":"RAP","\u91cc\u8d3e\u7eb3":"YQR","\u96f7\u6069":"RNS","\u91cc\u8bfa":"RNO","\u83b1\u56e0\u5170\u5fb7":"RHI","\u7f57\u5f97\uff08\u5c9b\uff09":"RHO","\u91cc\u58eb\u6ee1":"RIC","\u91cc\u52a0":"RIX","\u91cc\u7c73\u5c3c":"RMI","\u91cc\u7ea6\u70ed\u5185\u5362":"RIO","\u5229\u96c5\u5f97":"RUH","\u7f57\u963f\u8bfa\u514b":"ROA","\u7f57\u5207\u65af\u7279":"ROC","\u7f57\u514b\u798f\u5fb7":"RFD","\u7f57\u5fb7\u5179":"RDZ","\u7f57\u9a6c":"ROM","\u675c\u52d2\u65af":"IAD","\u9e7f\u7279\u4e39":"RTM","\u7f57\u74e6\u6d85\u7c73":"RVN","\u8428\u5c14\u5e03\u5415\u80af":"SCN","\u8428\u5409\u8bfa":"MBS","\u5723\u5362\u897f\u4e9a":"UVF","\u8d5b\u73ed\u5c9b":"SPN","\u76d0\u6e56\u57ce":"SLC","\u8428\u5c14\u8328\u5821":"SZG","\u5723\u5b89\u6566":"SAT","\u5723\u8fed\u6208":"SAN","\u65e7\u91d1\u5c71":"SFO","\u5723\u4f55\u585e":"SJC","\u5723\u8def\u6613\u65af-\u5965\u6bd4\u65af\u6ce2":"SBP","\u8428\u90a3":"SAH","\u5c71\u6253\u6839":"SDK","\u5723\u5b89\u5a1c":"SNA","\u5723\u5df4\u5df4\u62c9":"SBA","\u5723\u5730\u4e9a\u54e5":"SCU","\u5723\u5730\u4e9a\u54e5\u79d1\u6ce2\u6cf0\u62c9":"SCQ","\u5723\u5730\u7259\u54e5":"SCL","\u5723\u591a\u660e\u5404":"SDQ","\u5723\u4fdd\u7f57":"SAO","\u624e\u5e4c":"SPK","\u8428\u62c9\u70ed\u7a9d":"SJJ","\u8428\u65af\u5361\u901a":"YXE","\u82cf\u5723\u739b\u4e3d":"SSM","\u8428\u51e1\u7eb3":"SAV","\u897f\u96c5\u56fe":"SEA","\u4e09\u5b9d\u5784":"SRG","\u4ed9\u53f0":"SDJ","\u9996\u5c14":"ICN","\u585e\u7ef4\u83b1":"SVQ","\u9999\u519c":"SNN","\u6c99\u8fe6":"SHJ","\u4ec0\u91cc\u592b\u6ce2\u7279":"SHV","\u66b9\u7c92":"REP","\u65b0\u52a0\u5761":"SIN","\u82cf\u57ce":"SUX","\u82cf\u798f\u5c14\u65af":"FSD","\u8c22\u83b1\u592b\u7279\u5965":"SFT","\u65af\u79d1\u666e\u91cc":"SKP","\u7d22\u975e\u4e9a":"SOF","\u7d22\u7f57\u57ce":"SOC","\u5357\u672c\u5fb7":"SBN","\u5357\u5b89\u666e\u6566":"SOU","\u65af\u6ce2\u574e":"GEG","\u65af\u666e\u6797\u83f2\u5c14\u5fb7":"SGF","\u5723\u8def\u6613\u65af":"STL","\u5723\u5f7c\u5f97\u5821":"LED","\u65af\u5854\u4e07\u683c":"SVG","\u65af\u5fb7\u54e5\u5c14\u6469":"ARN","\u65bd\u7279\u62c9\u65af\u5821":"SXB","\u65af\u56fe\u52a0\u7279":"STR","\u677e\u5179\u74e6\u5c14":"SDL","\u6cd7\u6c34":"SUB","\u6089\u5c3c":"SYD","\u9521\u62c9\u4e18\u5179":"SYR","\u53f0\u5317":"TPE","\u5854\u62c9\u54c8\u897f":"TLH","\u5854\u6797":"TLL","\u5766\u5e15":"TPA","\u5766\u4f69\u96f7":"TMP","\u5766\u76ae\u79d1":"TAM","\u5854\u4ec0\u5e72":"TAS","\u6597\u6e56":"TWU","\u8482\u585e\u5fb7":"MME","\u5fb7\u9ed1\u5170":"THR","\u7279\u62c9\u7ef4\u592b-\u96c5\u6cd5":"TLV","\u7279\u79d1\u8428\u5361\u7eb3":"TXK","\u585e\u8428\u6d1b\u5c3c\u57fa":"SKG","\u7279\u91cc\u51e1\u5f97\u7405":"TRV","\u6851\u5fb7\u8d1d":"YQT","\u8482\u9c81\u5409\u62c9\u5e15\u5229":"TRZ","\u4e1c\u4eac":"TYO","\u6258\u83b1\u591a":"TOL","\u591a\u4f26\u591a":"YTO","\u571f\u4f26":"TLN","\u56fe\u5362\u5179":"TLS","\u5bcc\u5c71":"TOY","\u7279\u62c9\u5f17\u65af":"TVC","\u7684\u91cc\u96c5\u65af\u7279":"TRS","\u7684\u9ece\u6ce2\u91cc":"TIP","\u7279\u7f57\u59c6\u745f":"TOS","\u7279\u9686\u8d6b\u59c6":"TRD","\u56fe\u68ee":"TUS","\u5854\u5c14\u8428":"TUL","\u7a81\u5c3c\u65af":"TUN","\u56fe\u73c0\u6d1b":"TUP","\u90fd\u7075":"TRN","\u56fe\u5c14\u5e93":"TKU","\u7279\u6e29\u798f\u5c14\u65af":"TWF","\u4e4c\u5170\u5df4\u6258":"ULN","\u4e4c\u9ed8\u5965":"UME","\u74e6\u4f26\u897f\u4e9a":"VLC","\u74e6\u62c9\u591a\u5229\u5fb7":"VLL","\u6e29\u54e5\u534e":"YVR","\u97e6\u514b\u820d":"VXO","\u5a01\u5c3c\u65af":"VCE","\u7ef4\u7f57\u7eb3":"VRN","\u7ef4\u591a\u5229\u4e9a":"VCT","\u7ef4\u4e5f\u7eb3":"VIE","\u4e07\u8c61":"VTE","\u7ef4\u54e5":"VGO","\u7ef4\u5c14\u7ebd\u65af":"VNO","\u7b26\u62c9\u8fea\u6c83\u65af\u6258\u514b":"VVO","\u97e6\u79d1":"ACT","\u534e\u6c99":"WAW","\u534e\u76db\u987f":"WAS","\u6ed1\u94c1\u5362":"ALO","\u6c83\u7279\u6566":"ART","\u60e0\u7075\u987f":"WLG","\u897f\u68d5\u6988\u6ee9":"PBI","\u6000\u7279\u666e\u83b1\u6069\u65af":"HPN","\u5a01\u5947\u5854\u798f\u5c14\u65af":"ICT","\u6e29\u5c3c\u4f2f":"YWG","\u5f17\u7f57\u8328\u74e6\u592b":"WRO","\u4e9a\u57fa\u9a6c":"YKM","\u65e5\u60f9":"JOG","\u626c\u65af\u6566":"YNG","\u8428\u683c\u52d2\u5e03":"ZAG","\u82cf\u9ece\u4e16":"ZRH"};
// 选择国内机票时点击去哪网按钮触发的事件
function btn_search1(){
		// 定义出发城市
	var startCity = $("#owStart").val();
	
	// 如果用户未填写则把出发城市设置为北京
	if(!startCity || startCity.indexOf('出发')!=-1){
	
		startCity = "北京";
	}
	
	// 定义目的城市
	var endCity = $("#owEnd").val();
	
	// 如果用户未填写则把目标城市设置为上海
	if(!endCity || endCity.indexOf('到达')!=-1){
		
		endCity = "上海";
	}

	// 定义出发时间
	var startTime = $("#owTime").val();
	
	// 定义返回时间
	var endTime = $("#rdEndTime").val();
	
	//alert("1111111");
	//exit;
	
	// 用css判断是单程还是往返
	
	if($("#danchengOrwangfan").attr("class") == "v-item js-return-item gclearfix"){
		
		// 构造往返url地址
		var url = "http://flight.qunar.com/site/roundtrip_list_new.htm?fromCity="+startCity+"&toCity="+endCity+"&from=fi_sbox_search&fromDate="+startTime+"&toDate="+endTime+"&ex_track=auto_50ece83a";
		
		// 打开一个新的窗口
		window.open(url);
		
	} else {
		
		// 构造单程url地址
		var url = "http://flight.qunar.com/site/oneway_list.htm?searchDepartureAirport="+startCity+"&searchArrivalAirport="+endCity+"&nextNDays=0&startSearch=true&from=fi_sbox_search&searchDepartureTime="+startTime+"&ex_track=auto_50ece83a";
		//alert(url);
		//exit;
		// 打开一个新的窗口
		window.open(url);
	}

}

// 选择国际机票时点击去哪网按钮触发的事件
function guoji_btn_search1(){
	// 定义出发城市
	var startCity = $("#owInterStart").val();
	
	// 如果用户未填写则把出发城市设置为北京
	if(startCity==""){
		startCity = "北京";
	}
	
	// 定义目的城市
	var endCity = $("#owInterEnd").val();
	
	// 如果用户未填写则把目标城市设置为上海
	if(endCity == "" || endCity.indexOf('目的')!=-1){
		alert("请选择目的地");
		exit;
	}

	// 定义出发时间
	var startTime = $("#owInterTime").val();
	
	// 定义返回时间
	var endTime = $("#rdInterEndTime").val();
	
	
	
	// 用css判断是单程还是往返
	
	if($("#guojidanchengOrwangfan").attr("class") == "v-item js-return-item gclearfix"){
		
		// 构造往返url地址
		var url = "http://flight.qunar.com/site/interroundtrip_compare.htm?fromCity="+startCity+"&toCity="+endCity+"&from=fi_sbox_search&fromDate="+startTime+"&toDate="+endTime+"&ex_track=auto_50ece83a";
		
		// 打开一个新的窗口
		window.open(url);
		
	} else {
		
		// 构造单程url地址
		var url = "http://flight.qunar.com/site/oneway_list_inter.htm?searchDepartureAirport="+startCity+"&searchArrivalAirport="+endCity+"&nextNDays=0&startSearch=true&from=fi_sbox_search&searchDepartureTime="+startTime+"&ex_track=auto_50ece83a";
		
		// 打开一个新的窗口
		window.open(url);
	}
}

// 选择国内机票时点击酷讯网查询触发时间
function btn_search2(){
	// 定义出发城市
	var startCity = $("#owStart").val();
	
	// 如果用户未填写则把出发城市设置为北京
	if(startCity==""){
		startCity = "北京";
	}
	
	// 定义目的城市
	var endCity = $("#owEnd").val();
	
	// 如果用户未填写则把目标城市设置为上海
	if(endCity==""){
		endCity = "上海";
	}

	// 定义出发时间
	var startTime = $("#owTime").val();
	
	// 定义返回时间
	var endTime = $("#rdEndTime").val();
	
	// 用css判断是单程还是往返
	
	if($("#danchengOrwangfan").attr("class") == "v-item js-return-item gclearfix"){
		
		// 构造往返url地址
		var url = "http://jipiao.kuxun.cn/round-"+cA[startCity]+"-"+cA[endCity]+".html?"+startTime+"_"+endTime+"&fromid=K2345com1-S1388641-T1076501";
		
		// 打开一个新的窗口
		window.open(url);
		
	}else{
		// 构造单程url地址
		var url = "http://jipiao.kuxun.cn/"+cA[startCity]+"-"+cA[endCity]+".html?"+startTime+"&fromid=K2345com1-S1388641-T1076501";
		
		// 打开一个新的窗口
		window.open(url);
	}

}

// 选择国内机票时点击酷讯网查询触发时间
function guoji_btn_search2(){
	// 定义出发城市
	var startCity = $("#owInterStart").val();
	
	// 如果用户未填写则把出发城市设置为北京
	if(startCity==""){
		startCity = "北京";
	}
	
	// 定义目的城市
	var endCity = $("#owInterEnd").val();
	
	// 如果用户未填写则把目标城市设置为上海
	if(endCity == ""){
		alert("请选择目的地");
		exit;
	}
	if(cA[endCity]){
		var cityEnd= cA[endCity];
	}else{
		var cityEnd = ext_city_code_map[endCity];
	}
	
	if(cA[startCity]){
		var cityStart = cA[startCity];
	}else{
		var cityStart = ext_city_code_map[startCity];
	}
	// 定义出发时间
	var startTime = $("#owInterTime").val();
	
	// 定义返回时间
	var endTime = $("#rdInterEndTime").val();
	// 用css判断是单程还是往返
	
	if($("#guojidanchengOrwangfan").attr("class") == "v-item js-return-item gclearfix"){
		
		// 构造往返url地址
		var url = "http://jipiao.kuxun.cn/round-"+cityStart+"-"+cityEnd+"-guoji.html?"+startTime+"_"+endTime+"&fromid=K2345com1-S1388641-T1076501";
		
		// 打开一个新的窗口
		window.open(url);
		
	}else{
		// 构造单程url地址
		var url = "http://jipiao.kuxun.cn/"+cityStart+"-"+cityEnd+"-guoji.html?"+startTime+"&fromid=K2345com1-S1388641-T1076501";
		
		// 打开一个新的窗口
		window.open(url);
	}
}
$(function(){
// 国内的为单程往返添加点击事件
$("#RoundQuery").click(function(){
	$("#danchengOrwangfan").attr("class","v-item js-return-item gclearfix");
})
$("#OneWayQuery").click(function(){
	$("#danchengOrwangfan").attr("class","v-item js-return-item v-return gclearfix");
})

// 国际的为单程往返添加点击事件 
$("#roundInterQuery").click(function(){
	$("#guojidanchengOrwangfan").attr("class","v-item js-return-item gclearfix");
})
$("#oneWayInterQuery").click(function(){
	$("#guojidanchengOrwangfan").attr("class","v-item js-return-item v-return gclearfix");
})
})