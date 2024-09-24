<?php 

namespace App\Command;

use App\Repository\ContactRepository;
use App\Repository\UserRepository;
use App\Service\ContactService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class SendContactCommand extends Command
{
    private $contactRepository;
    private $mailer;
    private $contactService;
    private $userRepository;
    protected static $defaultName = 'app:send-contact';

    public function __construct(
        ContactRepository $contactRepository,
        MailerInterface $mailer,
        ContactService $contactService,
        UserRepository $userRepository
        ) {
            $this->contactRepository = $contactRepository;
            $this->mailer = $mailer;
            $this->contactService = $contactService;
            $this->userRepository = $userRepository;
            parent::__construct();
        }

        protected function execute(InputInterface $input, OutputInterface $output)
        {
            $toSend = $this->contactRepository->findBy(['isSend' => false]);

            if (empty($toSend)) {
                $output->writeln('Aucun contact à envoyer.');
                return Command::SUCCESS;
            }

            $gestionnaire = $this->userRepository->getGestionnaire();
            $address = new Address($gestionnaire->getEmail(), $gestionnaire->getNom() . ' ' . $gestionnaire->getPrenom());
        
            foreach ($toSend as $mail) {
                $output->writeln('Envoi d\'un e-mail à : ' . $gestionnaire->getEmail());

                $email = (new Email())
                    ->from($mail->getEmail())
                    ->to($address)
                    ->subject('Nouveau message de ' . $mail->getNom() .$mail->getPrenom() .'Objet du message : '. $mail->getObjet())
                    ->text($mail->getMessage());

                $this->mailer->send($email);

                $this->contactService->isSend($mail);
            }

            $output->writeln('Tous les e-mails ont été envoyés avec succès.');

            return Command::SUCCESS;
            }
        }
