<?php
/**
 * Plugin Name: DK Expressions Final Rate Card Download
 * Description: Serves the final 2026 seven-page DK Expressions commercial rate card as a downloadable PDF using the DK Colour System.
 * Version: 1.0.0
 * Author: DK Expressions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

final class DKX_Final_Rate_Card_PDF {
    private $pages = array();
    private $w = 595.276;
    private $h = 841.890;

    private function esc( $s ) {
        $s = str_replace( array('–','—','’','“','”','•'), array('-','-','\'','"','"','-'), (string) $s );
        $s = preg_replace('/[^\x20-\x7E]/', '', $s);
        return str_replace(array('\\','(',')'), array('\\\\','\\(','\\)'), $s);
    }
    private function rgb( $hex ) {
        $hex = ltrim($hex,'#');
        return array(hexdec(substr($hex,0,2))/255, hexdec(substr($hex,2,2))/255, hexdec(substr($hex,4,2))/255);
    }
    private function color( $hex ) {
        list($r,$g,$b) = $this->rgb($hex);
        return sprintf('%.4F %.4F %.4F rg', $r,$g,$b);
    }
    private function rect( &$s, $x,$y,$w,$h,$hex ) {
        $s .= $this->color($hex)."\n".sprintf('%.2F %.2F %.2F %.2F re f', $x,$y,$w,$h)."\n";
    }
    private function text( &$s, $x,$y,$text,$size=10,$bold=false,$hex='#02070C' ) {
        $font = $bold ? '/F2' : '/F1';
        $s .= $this->color($hex)."\nBT {$font} ".number_format($size,2,'.','')." Tf 1 0 0 1 ".number_format($x,2,'.','')." ".number_format($y,2,'.','')." Tm (".$this->esc($text).") Tj ET\n";
    }
    private function wrap( $text, $chars=78 ) {
        return explode("\n", wordwrap((string)$text,$chars,"\n",false));
    }
    private function para( &$s,$x,$y,$text,$size=9,$hex='#02070C',$bold=false,$chars=86,$lead=12 ) {
        foreach ( $this->wrap($text,$chars) as $line ) { $this->text($s,$x,$y,$line,$size,$bold,$hex); $y -= $lead; }
        return $y;
    }
    private function footer( &$s,$page ) {
        $this->rect($s,0,0,$this->w,31.2,'#02070C');
        $this->text($s,150,12,'DK EXPRESSIONS  /  FINAL COMMERCIAL RATE CARD  /  2026  /  PAGE '.$page.' OF 7',7,true,'#9DB2C2');
    }
    private function topbar( &$s,$label,$accent ) {
        $this->rect($s,0,790.9,$this->w,51,'#02070C');
        $this->rect($s,0,790.9,14.2,51,$accent);
        $this->text($s,34,809,$label,10,true,'#FFFFFF');
    }
    private function add_page( $stream ) { $this->pages[] = $stream; }

    private function card( &$s,$x,$top,$w,$h,$name,$price,$suffix,$desc,$features,$accent,$badge='' ) {
        $this->rect($s,$x,$top-$h,$w,$h,'#FFFFFF');
        $this->rect($s,$x,$top-6,$w,6,$accent);
        $this->text($s,$x+14,$top-28,strtoupper($name),9,true,'#02070C');
        if($badge){ $this->rect($s,$x+$w-70,$top-36,62,17,$accent); $this->text($s,$x+$w-64,$top-31,strtoupper($badge),6,true,'#02070C'); }
        $this->text($s,$x+14,$top-58,$price,16,true,$accent);
        if($suffix){ $this->text($s,$x+86,$top-58,$suffix,7,true,'#9DB2C2'); }
        $y = $this->para($s,$x+14,$top-82,$desc,7.2,'#9DB2C2',false,28,9);
        $y -= 5;
        foreach($features as $f){ $y = $this->para($s,$x+14,$y,'- '.$f,7,'#02070C',false,31,9); }
    }

    public function render() {
        $INK='#02070C'; $BLUE='#40B8FF'; $AQUA='#20D7C8'; $GOLD='#FFC34F'; $PURPLE='#976DFF'; $RED='#FF5364'; $ORANGE='#FF8A4C'; $MUTED='#9DB2C2';

        // Page 1 - Cover.
        $s=''; $this->rect($s,0,0,$this->w,$this->h,$INK);
        foreach(array($BLUE,$AQUA,$GOLD,$PURPLE,$RED,$ORANGE) as $i=>$c) $this->rect($s,$i*($this->w/6),824.9,$this->w/6,17,$c);
        $this->text($s,51,686,'DK',52,true,$BLUE); $this->text($s,51,638,'EXPRESSIONS',31,true,'#FFFFFF');
        $this->text($s,51,573,'FINAL RATE CARD',19,true,$GOLD); $this->text($s,51,544,'2026 COMMERCIAL EDITION',10,true,$AQUA);
        $this->text($s,51,454,'CLEAR PACKAGES. PREMIUM OUTPUT.',17,true,'#FFFFFF'); $this->text($s,51,423,'NO HOURLY SURPRISES.',17,true,$BLUE);
        $this->text($s,51,363,'Johannesburg + Cape Town, South Africa',9,false,$MUTED); $this->text($s,51,340,'South African Rand  |  Rates exclude VAT',9,false,$MUTED);
        $this->text($s,51,77,'PREMIUM CULTURE  /  CONTENT  /  BRAND STORYTELLING',9,true,'#FFFFFF'); $this->footer($s,1); $this->add_page($s);

        // Page 2 - Pricing at a glance.
        $s=''; $this->topbar($s,'COMMERCIAL SYSTEM / PRICING AT A GLANCE',$BLUE);
        $this->text($s,45,740,'SELL THE OUTCOME,',25,true,$INK); $this->text($s,45,706,'NOT THE HOUR.',25,true,$BLUE);
        $this->para($s,45,669,'Each core service has an entry tier, a deliberately anchored middle tier and a premium tier. Quote the middle tier first. Entry is the fallback, not the opener.',9,$MUTED,false,108,12);
        $rows=array(
            array('EVENT DOMINATION','R6,500','R32,000','FROM R95,000','PER EVENT',$BLUE),
            array('ALWAYS ON / BRAND RETAINER','R15,000','R35,000','FROM R60,000','MONTHLY',$GOLD),
            array('BECOME THE NAME / EXECUTIVE BRANDING','R18,000','R40,000','FROM R75,000','MONTHLY',$PURPLE),
            array('OWN THE ATTENTION / MEDIA PLACEMENTS','R1,500','R6,000','R12,500','CAMPAIGN',$RED),
        );
        $y=607;
        foreach($rows as $r){ $this->rect($s,45,$y-65,505,65,'#F4F7F9'); $this->rect($s,45,$y-65,9,65,$r[5]); $this->text($s,62,$y-37,$r[0],7.2,true,$INK); $this->text($s,283,$y-37,$r[1],8,true,$INK); $this->text($s,360,$y-37,$r[2],8,true,$r[5]); $this->text($s,436,$y-37,$r[3],8,true,$INK); $this->text($s,520,$y-37,$r[4],7.2,true,$INK); $y-=65; }
        $this->rect($s,45,79,505,99,$INK); $this->text($s,60,153,'COMMERCIAL FLOOR',8,true,$GOLD); $this->text($s,60,125,'MINIMUM NEW-CLIENT ENGAGEMENT: R7,500 EXCL. VAT',13,true,'#FFFFFF');
        $this->para($s,60,100,'Standalone items below this threshold should be sold inside a campaign, bundle or existing-client scope.',7.5,'#E6EEF3',false,105,10);
        $this->footer($s,2); $this->add_page($s);

        $services=array(
            array(3,'01 / EVENT DOMINATION',$BLUE,'EVENT DOMINATION','Full content coverage of a live event built for social impact, not just an archive of photos. Real-time capture, fast edits and a feed that makes the event feel bigger than the room.','Best for festivals, concerts, product launches, activations, conferences, expos and premium private events.',array(
                array('SPARK','R6,500','/ event','Entry coverage to get a brand in the door',array('Up to 4 hours on site','1 creator','40 edited photos','2 short-form reels','Next-day delivery'),''),
                array('SIGNATURE','R32,000','/ event','The core package most events should buy',array('Up to 8 hours','Photo + video','Live posting during the event','5 reels + 80 edited photos','Same-day teaser edit','Post-event recap reel'),'MOST CHOSEN'),
                array('TAKEOVER','FROM R95,000','','Multi-day or flagship productions',array('Crew of 2-4 creators','Real-time social management','Daily reels + stories','Creator/influencer coordination','Full post-event campaign + report'),'')
            )),
            array(4,'02 / ALWAYS ON / BRAND CONTENT RETAINER',$GOLD,'ALWAYS ON / BRAND CONTENT RETAINER','A fixed monthly content engine. DK Expressions becomes the creative team the brand does not have, producing premium photo, video, social content and strategy consistently.','Best for hospitality, nightlife, boutique hotels, real estate, lifestyle and premium consumer brands. Three-month minimum.',array(
                array('ESSENTIAL','R15,000','/ month','Consistent presence for one brand',array('1 content shoot per month','12 edited posts','4 reels','Monthly content calendar','Basic monthly report'),''),
                array('PREMIUM','R35,000','/ month','Full content and growth partner',array('2 shoots per month','20 posts + 8 reels','Full social media management','Content strategy + calendar','Paid-ad creative','Monthly performance report'),'MOST CHOSEN'),
                array('ELITE','FROM R60,000','/ month','Own the category online',array('Weekly shoots + content drops','Unlimited posts within scope','Full social + community management','Monthly event coverage','Paid-ad management','Dedicated strategy sessions'),'')
            )),
            array(5,'03 / BECOME THE NAME / EXECUTIVE PERSONAL BRANDING',$PURPLE,'BECOME THE NAME','Done-for-you authority building for founders, executives, entertainers and high-profile professionals through content, positioning and managed visibility.','Best for CEOs, founders, DJs, entertainers, luxury real-estate agents, coaches and high-profile entrepreneurs. Three-month minimum.',array(
                array('STARTER','R18,000','/ month','Show up consistently and look the part',array('1 shoot per month','12 personal-brand posts','4 short-form videos','Instagram + TikTok content'),''),
                array('GROWTH','R40,000','/ month','Build real authority and reach',array('2 shoots per month','20 posts + 8 videos','Personal-brand strategy','Full content management','Interview / talking-head series','Monthly review + reporting'),'MOST CHOSEN'),
                array('AUTHORITY','FROM R75,000','/ month','Become the name in your field',array('Weekly content production','Media + PR positioning','Podcast / video show production','Full multi-platform management','Ghostwriting + thought leadership','Quarterly brand strategy sessions'),'')
            ))
        );
        foreach($services as $svc){
            list($page,$label,$accent,$title,$desc,$best,$pkgs)=$svc; $s=''; $this->topbar($s,$label,$accent); $this->text($s,45,737,$title,24,true,$INK); $this->para($s,45,700,$desc,8.7,$INK,false,112,11); $this->para($s,45,671,$best,7.8,$MUTED,true,116,10);
            $x=45; foreach($pkgs as $i=>$p){ $this->card($s,$x,610,161,354,$p[0],$p[1],$p[2],$p[3],$p[4],$accent,$p[5]); $x+=172; }
            if($page===3){ $this->rect($s,45,62,505,60,$INK); $this->text($s,60,105,'ADD-ONS',7,true,$BLUE); $this->text($s,60,82,'Extra shooter R2,500/day  /  Drone R3,500  /  Rush same-hour edits R1,800  /  Branded frame or AR filter: quoted',7.2,true,'#FFFFFF'); }
            $this->footer($s,$page); $this->add_page($s);
        }

        // Page 6 - Media placements and social amplification.
        $s=''; $this->topbar($s,'04 / OWN THE ATTENTION / BLOG & MEDIA PLACEMENTS',$RED); $this->text($s,45,737,'OWN THE ATTENTION',24,true,$INK);
        $this->para($s,45,700,'Paid editorial placements on DK Expressions and amplification across social channels, monetising the publishing authority and audience built since 2013.',8.7,$INK,false,112,11);
        $this->para($s,45,671,'Best for brands, venues, events and products that want credible exposure without committing to a full retainer.',7.8,$MUTED,true,116,10);
        $pkgs=array(
            array('FEATURE','R1,500','/ placement','A focused sponsored editorial feature',array('1 dedicated editorial listing','1 social amplification post','Live for 12 months'),''),
            array('SPOTLIGHT','R6,000','/ campaign','Sustained presence over a season',array('8 editorial listings','Social amplification on each','Instagram + Facebook + X coverage','Campaign-window placement'),'BEST VALUE'),
            array('HEADLINE','R12,500','/ campaign','Dominant ongoing exposure',array('16 editorial listings','Full social amplification per post','Priority placement + tagging','Optional event-coverage tie-in'),'')
        );
        $x=45; foreach($pkgs as $p){ $this->card($s,$x,621,161,264,$p[0],$p[1],$p[2],$p[3],$p[4],$RED,$p[5]); $x+=172; }
        $this->text($s,45,170,'SOCIAL AMPLIFICATION - STANDALONE / ADD-ON',11,true,$INK);
        $social=array(array('INSTAGRAM','R300','R500','R1,200'),array('FACEBOOK','R1,100','R2,000','R5,000'),array('X (TWITTER)','R500','R850','R2,100'));
        $this->rect($s,45,133,505,26,$INK); foreach(array('CHANNEL','1 POST','2 POSTS','5 POSTS') as $i=>$h) $this->text($s,51+$i*126,143,$h,7,true,'#FFFFFF');
        $yy=108; foreach($social as $row){ $this->rect($s,45,$yy,505,25,'#F4F7F9'); foreach($row as $i=>$v) $this->text($s,51+$i*126,$yy+9,$v,7.5,$i>0,$INK); $yy-=25; }
        $this->footer($s,6); $this->add_page($s);

        // Page 7 - Bundles and rules.
        $s=''; $this->topbar($s,'FAST-START BUNDLES / COMMERCIAL RULES',$AQUA); $this->text($s,45,737,'FAST-START BUNDLES',24,true,$INK);
        $bundles=array(array('LAUNCH SPARK','R7,500','Compact launch / announcement package and minimum new-client entry point.'),array('EVENT STORY','R15,000','Stronger event storytelling entry point for clients not ready for Signature.'),array('BRAND MOMENTUM','R14,500','Focused content / campaign bundle for brands testing an ongoing relationship.'));
        $x=45; foreach($bundles as $b){ $this->rect($s,$x,541,161,156,'#07131C'); $this->rect($s,$x,691,161,6,$AQUA); $this->text($s,$x+14,663,$b[0],8,true,$AQUA); $this->text($s,$x+14,629,$b[1],20,true,'#FFFFFF'); $this->para($s,$x+14,601,$b[2],7.2,$MUTED,false,31,10); $x+=172; }
        $this->text($s,45,505,'COMMERCIAL RULES',20,true,$INK);
        $rules=array('All rates are starting prices and exclude VAT.','50% deposit before work begins. No deposit, no booking.','All monthly retainers carry a three-month minimum.','Quote the core / anchor tier first. Entry is the fallback, not the opener.','Discount scope, never rate. If budget drops, remove deliverables.','Photography never sells below R5,000; event coverage never below R6,500.','Minimum new-client engagement: R7,500 excl. VAT.','Travel, accommodation, venue fees, paid media spend, talent fees and third-party costs are excluded unless expressly included.','Custom integrated campaigns, Web & AI builds, complex production and long-term partnerships are quoted to scope.','Rates valid to 31 December 2026 unless superseded by a newer DK Expressions commercial rate card.');
        $yy=471; foreach($rules as $r){ $this->rect($s,48,$yy,6,6,$ORANGE); $yy=$this->para($s,65,$yy,$r,7.5,$INK,false,112,10)-6; }
        $this->rect($s,45,57,505,91,$INK); $this->text($s,60,122,'CUSTOM / BESPOKE',8,true,$GOLD); $this->text($s,60,97,'Need something outside the packages? We quote the connected solution to scope.',12,true,'#FFFFFF');
        $this->footer($s,7); $this->add_page($s);

        return $this->build_pdf();
    }

    private function build_pdf() {
        $objects=array();
        $objects[3]='<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica /Encoding /WinAnsiEncoding >>';
        $objects[4]='<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold /Encoding /WinAnsiEncoding >>';
        $kids=array(); $id=5;
        foreach($this->pages as $stream){
            $page_id=$id++; $content_id=$id++; $kids[]=$page_id.' 0 R';
            $objects[$page_id]='<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595.276 841.890] /Resources << /Font << /F1 3 0 R /F2 4 0 R >> >> /Contents '.$content_id.' 0 R >>';
            $objects[$content_id]='<< /Length '.strlen($stream).' >>' . "\nstream\n".$stream."\nendstream";
        }
        $objects[2]='<< /Type /Pages /Count '.count($kids).' /Kids [ '.implode(' ',$kids).' ] >>';
        $objects[1]='<< /Type /Catalog /Pages 2 0 R >>';
        ksort($objects);
        $pdf="%PDF-1.4\n%DKX2026\n"; $offsets=array(0);
        foreach($objects as $num=>$body){ $offsets[$num]=strlen($pdf); $pdf.=$num." 0 obj\n".$body."\nendobj\n"; }
        $xref=strlen($pdf); $max=max(array_keys($objects));
        $pdf.="xref\n0 ".($max+1)."\n0000000000 65535 f \n";
        for($i=1;$i<=$max;$i++) $pdf.=sprintf('%010d 00000 n ', isset($offsets[$i])?$offsets[$i]:0)."\n";
        $pdf.="trailer\n<< /Size ".($max+1)." /Root 1 0 R >>\nstartxref\n".$xref."\n%%EOF\n";
        return $pdf;
    }
}

function dkx_final_rate_card_download_url() {
    return add_query_arg('dkx_rate_card','final-2026',home_url('/'));
}

add_action('template_redirect', function(){
    if ( ! isset($_GET['dkx_rate_card']) || 'final-2026' !== sanitize_key(wp_unslash($_GET['dkx_rate_card'])) ) return;
    nocache_headers();
    $pdf=(new DKX_Final_Rate_Card_PDF())->render();
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="DK-Expressions-2026-Rate-Card.pdf"');
    header('Content-Length: '.strlen($pdf));
    header('X-Content-Type-Options: nosniff');
    echo $pdf;
    exit;
},0);
