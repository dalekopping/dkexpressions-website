<?php
/**
 * Plugin Name: DK Expressions One-Page Rate Card Download
 * Description: Serves the 2026 one-page DK Expressions commercial rate card in PDF and editable Word formats.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function dkx_one_page_rate_card_pdf_url() {
    return add_query_arg( 'dkx_rate_card', 'one-page-pdf-2026', home_url( '/' ) );
}
function dkx_one_page_rate_card_docx_url() {
    return add_query_arg( 'dkx_rate_card', 'one-page-docx-2026', home_url( '/' ) );
}

final class DKX_One_Page_Rate_Card_PDF {
    private function esc( $s ) {
        $s = preg_replace( '/[^\x20-\x7E]/', ' ', (string) $s );
        return str_replace( array('\\','(',')'), array('\\\\','\\(','\\)'), $s );
    }
    private function rgb( $hex ) {
        $hex = ltrim( $hex, '#' );
        return array( hexdec(substr($hex,0,2))/255, hexdec(substr($hex,2,2))/255, hexdec(substr($hex,4,2))/255 );
    }
    private function color( $hex ) {
        list($r,$g,$b) = $this->rgb($hex);
        return sprintf('%.4F %.4F %.4F rg',$r,$g,$b);
    }
    private function rect( &$s,$x,$y,$w,$h,$hex ) {
        $s .= $this->color($hex)."\n".sprintf('%.2F %.2F %.2F %.2F re f',$x,$y,$w,$h)."\n";
    }
    private function text( &$s,$x,$y,$text,$size=8,$bold=false,$hex='#17202A' ) {
        $font=$bold?'/F2':'/F1';
        $s .= $this->color($hex)."\nBT {$font} ".number_format($size,2,'.','')." Tf 1 0 0 1 ".number_format($x,2,'.','')." ".number_format($y,2,'.','')." Tm (".$this->esc($text).") Tj ET\n";
    }
    private function wrap( $text,$chars=48 ) { return explode("\n",wordwrap((string)$text,$chars,"\n",false)); }
    private function para( &$s,$x,$y,$text,$size=6.4,$hex='#516571',$bold=false,$chars=50,$lead=8 ) {
        foreach($this->wrap($text,$chars) as $line){ $this->text($s,$x,$y,$line,$size,$bold,$hex); $y-=$lead; }
        return $y;
    }
    private function service( &$s,$y,$num,$title,$accent,$tiers,$minimum='' ) {
        $INK='#02070C'; $WHITE='#FFFFFF'; $PALE='#F3F6F8'; $MUTED='#516571';
        $this->rect($s,24,$y-82,792,82,$INK);
        $this->rect($s,24,$y-82,7,82,$accent);
        $this->text($s,38,$y-22,$num.' /',7,true,$accent);
        $this->text($s,38,$y-39,$title,8.4,true,$WHITE);
        if($minimum) $this->text($s,38,$y-55,$minimum,5.5,true,'#9DB2C2');
        $x=190;
        foreach($tiers as $i=>$t){
            $w=203;
            $this->rect($s,$x,$y-82,$w,82,$i===1?'#F8F5E9':$PALE);
            $this->text($s,$x+10,$y-17,$t[0],6.8,true,$i===1?$accent:$INK);
            if($i===1) $this->text($s,$x+103,$y-17,$title==='OWN THE ATTENTION / MEDIA PLACEMENTS'?'BEST VALUE':'MOST CHOSEN',4.9,true,$accent);
            $this->text($s,$x+10,$y-35,$t[1],10.5,true,$INK);
            $this->para($s,$x+10,$y-51,$t[2],5.5,$MUTED,false,44,6.3);
            $x+=$w+3;
        }
    }
    public function render() {
        $W=841.89; $H=595.276; $INK='#02070C'; $BLUE='#40B8FF'; $AQUA='#20D7C8'; $GOLD='#FFC34F'; $PURPLE='#976DFF'; $RED='#FF5364'; $ORANGE='#FF8A4C'; $WHITE='#FFFFFF'; $MUTED='#9DB2C2';
        $s=''; $this->rect($s,0,0,$W,$H,'#FFFFFF');
        $this->rect($s,20,522,802,54,$INK);
        foreach(array($BLUE,$AQUA,$GOLD,$PURPLE,$RED,$ORANGE) as $i=>$c) $this->rect($s,20+$i*(802/6),576,802/6,5,$c);
        $this->text($s,36,555,'DK EXPRESSIONS',16,true,$WHITE);
        $this->text($s,36,538,'2026 ONE-PAGE COMMERCIAL RATE CARD',7.4,true,$GOLD);
        $this->text($s,440,555,'CLEAR PACKAGES. FIXED SCOPES. NO HOURLY SURPRISES.',7.2,true,$BLUE);
        $this->text($s,641,538,'JHB + CAPE TOWN  /  ZAR  /  EXCL. VAT',5.8,true,$AQUA);

        $this->service($s,507,'01','EVENT DOMINATION',$BLUE,array(
            array('SPARK','R6,500 / EVENT','Up to 4 hrs | 1 creator | 40 photos | 2 reels | next-day delivery'),
            array('SIGNATURE','R32,000 / EVENT','Up to 8 hrs | photo + video | live posting | 5 reels + 80 photos | same-day teaser + recap'),
            array('TAKEOVER','FROM R95,000','2-4 creators | real-time social | daily reels/stories | coordination | full campaign + report')
        ));
        $this->service($s,419,'02','ALWAYS ON / BRAND CONTENT RETAINER',$GOLD,array(
            array('ESSENTIAL','R15,000 / MONTH','1 shoot | 12 posts | 4 reels | content calendar | basic report'),
            array('PREMIUM','R35,000 / MONTH','2 shoots | 20 posts + 8 reels | full social management | strategy | ad creative | report'),
            array('ELITE','FROM R60,000 / MONTH','Weekly shoots | unlimited posts in scope | community | monthly event | paid ads | strategy')
        ),'3-MONTH MINIMUM');
        $this->service($s,331,'03','BECOME THE NAME / EXECUTIVE BRANDING',$PURPLE,array(
            array('STARTER','R18,000 / MONTH','1 shoot | 12 personal-brand posts | 4 videos | Instagram + TikTok'),
            array('GROWTH','R40,000 / MONTH','2 shoots | 20 posts + 8 videos | strategy | content management | interview series | reporting'),
            array('AUTHORITY','FROM R75,000 / MONTH','Weekly production | PR positioning | podcast/video show | multi-platform | ghostwriting | strategy')
        ),'3-MONTH MINIMUM');
        $this->service($s,243,'04','OWN THE ATTENTION / MEDIA PLACEMENTS',$RED,array(
            array('FEATURE','R1,500 / PLACEMENT','1 editorial listing | 1 social amplification post | live for 12 months'),
            array('SPOTLIGHT','R6,000 / CAMPAIGN','8 editorial listings | amplification | Instagram + Facebook + X | campaign window'),
            array('HEADLINE','R12,500 / CAMPAIGN','16 editorial listings | full amplification | priority placement/tagging | optional event tie-in')
        ));

        $this->rect($s,24,64,390,86,$INK); $this->text($s,38,132,'ADD-ONS + SOCIAL AMPLIFICATION',7,true,$AQUA);
        $this->text($s,38,114,'Event: extra shooter R2,500/day | drone R3,500 | rush edits R1,800',5.8,false,'#E6EEF3');
        $this->text($s,38,98,'Instagram R300 / R500 / R1,200   Facebook R1,100 / R2,000 / R5,000',5.8,false,'#E6EEF3');
        $this->text($s,38,82,'X: R500 / R850 / R2,100   Banner placements quoted',5.8,false,'#E6EEF3');

        $this->rect($s,420,64,402,86,$INK); $this->text($s,434,132,'COMMERCIAL RULES',7,true,$ORANGE);
        $this->text($s,434,114,'50% deposit | 3-month retainer minimum | quote anchor tier first',5.8,false,'#E6EEF3');
        $this->text($s,434,98,'Photography floor R5,000 | event floor R6,500 | new-client minimum R7,500',5.8,false,'#E6EEF3');
        $this->text($s,434,82,'Travel, media spend and third-party costs excluded unless quoted',5.8,false,'#E6EEF3');
        $this->text($s,24,43,'CUSTOM / BESPOKE CAMPAIGNS, WEB & AI, COMPLEX PRODUCTION AND LONG-TERM PARTNERSHIPS ARE QUOTED TO SCOPE.',6,true,$BLUE);
        $this->text($s,643,26,'VALID TO 31 DECEMBER 2026',5.5,true,$MUTED);

        $objects=array();
        $objects[1]='<< /Type /Catalog /Pages 2 0 R >>';
        $objects[2]='<< /Type /Pages /Kids [3 0 R] /Count 1 >>';
        $objects[3]='<< /Type /Page /Parent 2 0 R /MediaBox [0 0 '.$W.' '.$H.'] /Resources << /Font << /F1 5 0 R /F2 6 0 R >> >> /Contents 4 0 R >>';
        $objects[4]='<< /Length '.strlen($s).' >>' . "\nstream\n".$s."endstream";
        $objects[5]='<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>';
        $objects[6]='<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold >>';
        $pdf="%PDF-1.4\n"; $offsets=array(0);
        for($i=1;$i<=6;$i++){ $offsets[$i]=strlen($pdf); $pdf.=$i." 0 obj\n".$objects[$i]."\nendobj\n"; }
        $xref=strlen($pdf); $pdf.="xref\n0 7\n0000000000 65535 f \n";
        for($i=1;$i<=6;$i++) $pdf.=sprintf('%010d 00000 n ',$offsets[$i])."\n";
        $pdf.="trailer\n<< /Size 7 /Root 1 0 R >>\nstartxref\n{$xref}\n%%EOF";
        return $pdf;
    }
}

function dkx_one_page_rate_card_docx_binary() {
    if ( ! class_exists( 'ZipArchive' ) ) return false;
    $tmp = wp_tempnam( 'dkx-one-page-rate-card.docx' );
    $zip = new ZipArchive();
    if ( true !== $zip->open( $tmp, ZipArchive::CREATE | ZipArchive::OVERWRITE ) ) return false;
    $types='<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types"><Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/><Default Extension="xml" ContentType="application/xml"/><Override PartName="/word/document.xml" ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.document.main+xml"/><Override PartName="/word/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.styles+xml"/></Types>';
    $rels='<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="word/document.xml"/></Relationships>';
    $docrels='<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"></Relationships>';
    $styles='<?xml version="1.0" encoding="UTF-8" standalone="yes"?><w:styles xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main"><w:style w:type="paragraph" w:default="1" w:styleId="Normal"><w:name w:val="Normal"/><w:rPr><w:rFonts w:ascii="Arial" w:hAnsi="Arial"/><w:sz w:val="16"/></w:rPr></w:style></w:styles>';
    $rows=array(
        array('01 / EVENT DOMINATION','Spark - R6,500/event','Signature - R32,000/event - MOST CHOSEN','Takeover - From R95,000'),
        array('02 / ALWAYS ON / BRAND CONTENT RETAINER','Essential - R15,000/month','Premium - R35,000/month - MOST CHOSEN','Elite - From R60,000/month'),
        array('03 / BECOME THE NAME / EXECUTIVE BRANDING','Starter - R18,000/month','Growth - R40,000/month - MOST CHOSEN','Authority - From R75,000/month'),
        array('04 / OWN THE ATTENTION / MEDIA PLACEMENTS','Feature - R1,500/placement','Spotlight - R6,000/campaign - BEST VALUE','Headline - R12,500/campaign')
    );
    $xml='<?xml version="1.0" encoding="UTF-8" standalone="yes"?><w:document xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main"><w:body>';
    $xml.='<w:p><w:r><w:rPr><w:b/><w:color w:val="40B8FF"/><w:sz w:val="38"/></w:rPr><w:t>DK EXPRESSIONS</w:t></w:r></w:p>';
    $xml.='<w:p><w:r><w:rPr><w:b/><w:color w:val="FFC34F"/><w:sz w:val="22"/></w:rPr><w:t>2026 ONE-PAGE COMMERCIAL RATE CARD</w:t></w:r></w:p>';
    $xml.='<w:p><w:r><w:rPr><w:b/><w:color w:val="02070C"/></w:rPr><w:t>CLEAR PACKAGES. FIXED SCOPES. NO HOURLY SURPRISES.</w:t></w:r></w:p>';
    foreach($rows as $r){
        $xml.='<w:p><w:r><w:rPr><w:b/><w:color w:val="02070C"/><w:sz w:val="20"/></w:rPr><w:t>'.esc_html($r[0]).'</w:t></w:r></w:p>';
        $xml.='<w:tbl><w:tblPr><w:tblW w:w="0" w:type="auto"/></w:tblPr><w:tr>';
        for($i=1;$i<=3;$i++) $xml.='<w:tc><w:tcPr><w:shd w:fill="F3F6F8"/></w:tcPr><w:p><w:r><w:rPr><w:b/></w:rPr><w:t>'.esc_html($r[$i]).'</w:t></w:r></w:p></w:tc>';
        $xml.='</w:tr></w:tbl>';
    }
    $xml.='<w:p><w:r><w:rPr><w:b/><w:color w:val="20D7C8"/></w:rPr><w:t>ADD-ONS + SOCIAL AMPLIFICATION</w:t></w:r></w:p>';
    $xml.='<w:p><w:r><w:t>Extra shooter R2,500/day | Drone R3,500 | Rush edits R1,800 | Instagram R300/R500/R1,200 | Facebook R1,100/R2,000/R5,000 | X R500/R850/R2,100</w:t></w:r></w:p>';
    $xml.='<w:p><w:r><w:rPr><w:b/><w:color w:val="FF8A4C"/></w:rPr><w:t>COMMERCIAL RULES</w:t></w:r></w:p>';
    $xml.='<w:p><w:r><w:t>50% deposit. Three-month retainer minimum. Quote anchor tier first. Photography floor R5,000. Event floor R6,500. Minimum new-client engagement R7,500 excl. VAT. Travel, media spend and third-party costs excluded unless quoted.</w:t></w:r></w:p>';
    $xml.='<w:sectPr><w:pgSz w:w="16838" w:h="11906" w:orient="landscape"/><w:pgMar w:top="400" w:right="500" w:bottom="400" w:left="500"/></w:sectPr></w:body></w:document>';
    $zip->addFromString('[Content_Types].xml',$types);
    $zip->addFromString('_rels/.rels',$rels);
    $zip->addFromString('word/_rels/document.xml.rels',$docrels);
    $zip->addFromString('word/styles.xml',$styles);
    $zip->addFromString('word/document.xml',$xml);
    $zip->close();
    $bin=file_get_contents($tmp); @unlink($tmp); return $bin;
}

add_action( 'template_redirect', function() {
    if ( ! isset($_GET['dkx_rate_card']) ) return;
    $key=sanitize_key(wp_unslash($_GET['dkx_rate_card']));
    if ( 'one-page-pdf-2026' === $key ) {
        nocache_headers();
        $pdf=(new DKX_One_Page_Rate_Card_PDF())->render();
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="DK-Expressions-2026-One-Page-Rate-Card.pdf"');
        header('Content-Length: '.strlen($pdf));
        echo $pdf; exit;
    }
    if ( 'one-page-docx-2026' === $key ) {
        nocache_headers();
        $docx=dkx_one_page_rate_card_docx_binary();
        if(false===$docx){ status_header(500); exit('Word download could not be generated on this server.'); }
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment; filename="DK-Expressions-2026-One-Page-Rate-Card.docx"');
        header('Content-Length: '.strlen($docx));
        echo $docx; exit;
    }
}, 0 );
