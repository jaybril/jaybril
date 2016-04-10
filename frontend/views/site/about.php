<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use common\widgets\pageUrl;
use frontend\models\LoginForm;
use common\widgets\Tool;
$this->title = '关于我们';
$this->keywords='叮叮功课登录 功课辅导 三人小班 广州家教 互联网家教';
$this->description='广州叮叮功课';

?>
<?=$this->render('/layouts/default_header',['type'=>'default','backUrl'=>'/','title'=>'关于我们']);?>
<div class="about">
  <div class="about-logo">
    <img src="/img/ddgklogo.png">
  </div>
  <div class="about-con">
    <p>叮叮功课，是中侨集团旗下互联网教育项目，专注于小学生最切身需求的4大板块——“功课辅导”、“素质培养”、“能力开发”和“亲子体验”。叮叮功课的核心理念：有效学习，快乐成长，能力开发，全方位发展！</p>

    <p>叮叮功课，通过先进的互联网技术，凝聚优质的师资团队，整合国内外最先进的课程体系，配合良好的学习环境，给予学生最优质的学习体验与活动体验，激发浓厚兴趣，培养正确习惯，有效地提高学生的“学习质量”和“综合能力”。</p>

    <p>
      叮叮功课，聚集了数十位来自“北京大学”、“清华大学”、“北京师大”、“华东师大”的教育专家，对目前国内外数十个先进的小学教育课程体系进行了长达5年的深入研究，提取各家精华，结合自主研发，最终形成了精益求精的“叮叮功课教学体系”。该教学体系，分为四大板块：</p>
    <ul>
      <li>（1）每天功课过关辅导；</li>
      <li>（2）素质课程快乐体验；</li>
      <li>（3）能力开发综合提高；</li>
      <li>（4）亲子活动健康成长！四大板块有机结合，连成整体，给孩子提供优质的学习、活动、成长、亲子体验，伴随孩子进步每一天。</li>
    </ul>
    <p>
      叮叮功课，既能有效解决孩子下午3点多放学之后的托管照顾、功课辅导问题，一站式服务，安全便捷，又能让孩子快乐地参加自己喜欢的素质教育兴趣课程，开拓视野，开发潜能，提高孩子思考、创新和动手能力，同时，叮叮功课还准备了非常先进、非常丰富的情商锻炼体验活动，培养孩子健全的人格和良好的个性，为其未来的发展打下坚实的基础，最后，叮叮功课为每个家庭精心设计了大量的亲子体验活动，亲情无障碍，成长更健康。</p>

    <p>叮叮功课，安全，便捷，快乐，有效，是最优质的小学生“功课辅导”与“综合发展”教育品牌。</p>
  </div>
</div>
