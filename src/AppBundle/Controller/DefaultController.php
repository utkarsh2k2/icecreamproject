<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AppBundle\Entity\Order;
use AppBundle\Form\Type\OrderType;
use AppBundle\Service\TotalCostUtility;
use AppBundle\Constants\Flavour;
use AppBundle\Constants\Topping;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        
        return $this->render('@App/Home/homepage.html.twig', [
                    'flavours' => Flavour::FLAVOURS,
                    'toppings' => Topping::TOPPINGS,
                    'flavourcosts' => Flavour::FLAVOURCOST,
                    'toppingcosts' => Topping::TOPPINGCOST,
        ]);
    }

    /**
     * @Route("/createorder", name="createorderpage")
     */
    public function createorderAction(Request $request, TotalCostUtility $costutility) {
        $em = $this->getDoctrine()->getManager();
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $totalcost = $costutility->getOrderCost($order);
            $order->setCost($totalcost);
            $em->persist($order);
            $em->flush();
            // redirect to order summarypage with order id
            $url = $this->generateUrl('summarypage', array('id' => $order->getId()));
            $response = new RedirectResponse($url);
            return $response;
        }
        
        return $this->render('@App/Order/createorderpage.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/summary/{id}", name="summarypage")
     * @ParamConverter("order", class="AppBundle:Order")
     */
    public function summaryAction(Request $request, Order $order) {
        // render ordersummarypage with order object
        return $this->render('@App/Order/summarypage.html.twig', array(
                    'order' => $order,
                    'flavourconstants' => Flavour::FLAVOURS,
                    'toppingconstants' => Topping::TOPPINGS,
        ));
    }
}
