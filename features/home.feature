Feature: Accueil
	Test d'accès à la page d'accueil de Agora-project

Scenario: Accéder à la page d'accueil
	Given I am on homepage
	Then I should see "Agora-Project"